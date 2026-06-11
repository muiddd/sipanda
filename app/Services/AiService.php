<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiService
{
    /**
     * Generate content using the configured AI provider.
     *
     * @param string $prompt
     * @param string|null $systemInstruction
     * @return array Contains 'text', 'prompt_tokens', 'completion_tokens', and 'total_tokens'
     * @throws \Exception
     */
    public static function generate($prompt, $systemInstruction = null)
    {
        $provider = env('AI_PROVIDER', 'gemini');

        if ($provider === 'gemini') {
            $apiKey = env('GEMINI_API_KEY');
            if (!$apiKey) {
                throw new \Exception('GEMINI_API_KEY belum diatur di file .env');
            }

            $model = env('GEMINI_MODEL', 'gemini-2.5-flash');
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ];

            if ($systemInstruction) {
                $payload['systemInstruction'] = [
                    'parts' => [
                        ['text' => $systemInstruction]
                    ]
                ];
            }

            $response = Http::withoutVerifying()->post($url, $payload);

            if ($response->failed()) {
                $status = $response->status();
                $errMsg = $response->json('error.message') ?? $response->body();
                
                if ($status === 404) {
                    try {
                        $listUrl = "https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}";
                        $listResponse = Http::withoutVerifying()->get($listUrl);
                        if ($listResponse->successful()) {
                            $modelsList = $listResponse->json('models') ?? [];
                            $supported = [];
                            foreach ($modelsList as $m) {
                                if (in_array('generateContent', $m['supportedGenerationMethods'] ?? [])) {
                                    $supported[] = str_replace('models/', '', $m['name']);
                                }
                            }
                            $errMsg .= " | Model yang didukung oleh API key Anda: " . implode(', ', $supported);
                        }
                    } catch (\Exception $ex) {
                        // Ignore model list failures
                    }
                }
                throw new \Exception('API Gemini gagal merespon (' . $status . '): ' . $errMsg);
            }

            $result = $response->json();
            $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (!$text) {
                throw new \Exception('Gemini mengembalikan respon kosong.');
            }

            $usage = $result['usageMetadata'] ?? [];
            $promptTokens = $usage['promptTokenCount'] ?? str_word_count($prompt);
            $completionTokens = $usage['candidatesTokenCount'] ?? str_word_count($text);
            $totalTokens = $usage['totalTokenCount'] ?? ($promptTokens + $completionTokens);

            return [
                'text' => $text,
                'prompt_tokens' => $promptTokens,
                'completion_tokens' => $completionTokens,
                'total_tokens' => $totalTokens,
            ];
        } else {
            // OpenRouter fallback
            $apiKey = config('services.openrouter.api_key');
            if (!$apiKey) {
                throw new \Exception('OPENROUTER_API_KEY belum diatur di file .env');
            }

            $model = config('services.openrouter.model', 'openrouter/free');
            $url = 'https://openrouter.ai/api/v1/chat/completions';

            $messages = [];
            if ($systemInstruction) {
                $messages[] = ['role' => 'system', 'content' => $systemInstruction];
            }
            $messages[] = ['role' => 'user', 'content' => $prompt];

            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'siPanda Learning App',
            ])->post($url, [
                'model' => $model,
                'messages' => $messages,
            ]);

            if ($response->failed()) {
                throw new \Exception('API OpenRouter gagal merespon (' . $response->status() . '): ' . ($response->json('error.message') ?? $response->body()));
            }

            $result = $response->json();
            $text = $result['choices'][0]['message']['content'] ?? null;

            if (!$text) {
                throw new \Exception('OpenRouter mengembalikan respon kosong.');
            }

            $usage = $result['usage'] ?? [];
            $promptTokens = $usage['prompt_tokens'] ?? str_word_count($prompt);
            $completionTokens = $usage['completion_tokens'] ?? str_word_count($text);
            $totalTokens = $usage['total_tokens'] ?? ($promptTokens + $completionTokens);

            return [
                'text' => $text,
                'prompt_tokens' => $promptTokens,
                'completion_tokens' => $completionTokens,
                'total_tokens' => $totalTokens,
            ];
        }
    }
}
