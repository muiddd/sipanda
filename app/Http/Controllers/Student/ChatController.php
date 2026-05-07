<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AiSummary;
use Smalot\PdfParser\Parser;

class ChatController extends Controller
{
    public function index()
    {
        $chats = ChatMessage::where('user_id', auth()->id())
                    ->orderBy('created_at', 'asc')
                    ->get();

        $summary = AiSummary::where('user_id', auth()->id())->latest()->first();

        return view('student.dashboard', compact('chats', 'summary'));
    }

    public function gamifikasi()
    {
        // Data for Learning Session Chart
        $learningSessions = \App\Models\LearningSession::where('user_id', auth()->id())
            ->where('start_time', '>=', now()->subDays(6)->startOfDay())
            ->get()
            ->groupBy(function($session) {
                return \Carbon\Carbon::parse($session->start_time)->format('Y-m-d');
            });
            

        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->translatedFormat('D'); // Mon, Tue, etc.
            $chartLabels[] = $label;
            
            $duration = isset($learningSessions[$date]) ? $learningSessions[$date]->sum('duration') : 0;
            $chartData[] = $duration;
        }

        $totalMinutes = \App\Models\LearningSession::where('user_id', auth()->id())->where('status', 'completed')->sum('duration');
        $hours = floor($totalMinutes / 60);
        $mins = $totalMinutes % 60;

        return view('student.gamifikasi', compact('chartLabels', 'chartData', 'hours', 'mins'));
    }

       public function latihanSoal()
    {
        return view('student.latihansoal');
    }

        public function materi()
{
    $materiData = [
        'smp' => [
            'label' => 'SMP',
            'subjects' => [
                [
                    'icon' => '➗',
                    'title' => 'Matematika',
                    'slug' => 'matematika-smp',
                    'topics' => [
                        ['name' => 'Bilangan Bulat & Pecahan',    'meta' => '5 sub-topik · 12 soal', 'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Aljabar & Persamaan Linear',  'meta' => '4 sub-topik · 18 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Geometri & Bangun Datar',     'meta' => '6 sub-topik · 20 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Statistika Dasar',            'meta' => '3 sub-topik · 10 soal', 'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Himpunan',                    'meta' => '3 sub-topik · 8 soal',  'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Fungsi & Grafik',             'meta' => '3 sub-topik · 15 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🔬',
                    'title' => 'IPA',
                    'slug' => 'ipa-smp',
                    'topics' => [
                        ['name' => 'Sel & Struktur Makhluk Hidup', 'meta' => '4 sub-topik · 14 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Gaya & Gerak',                 'meta' => '5 sub-topik · 16 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Zat & Perubahannya',           'meta' => '4 sub-topik · 12 soal', 'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Cahaya & Optik',               'meta' => '3 sub-topik · 10 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Ekosistem & Lingkungan',       'meta' => '3 sub-topik · 9 soal',  'diff' => 'easy', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🌍',
                    'title' => 'IPS',
                    'slug' => 'ips-smp',
                    'topics' => [
                        ['name' => 'Peta & Keruangan',       'meta' => '3 sub-topik · 8 soal',  'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Sejarah Indonesia Kuno', 'meta' => '4 sub-topik · 12 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Ekonomi Dasar',          'meta' => '4 sub-topik · 11 soal', 'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Keberagaman Masyarakat', 'meta' => '3 sub-topik · 9 soal',  'diff' => 'easy', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '📖',
                    'title' => 'Bahasa Indonesia',
                    'slug' => 'bahasa-indonesia-smp',
                    'topics' => [
                        ['name' => 'Teks Narasi & Deskripsi', 'meta' => '3 sub-topik · 10 soal', 'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Teks Eksposisi',          'meta' => '3 sub-topik · 8 soal',  'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Puisi & Pantun',          'meta' => '3 sub-topik · 7 soal',  'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Ejaan & Tata Bahasa',     'meta' => '4 sub-topik · 15 soal', 'diff' => 'mid',  'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🌐',
                    'title' => 'Bahasa Inggris',
                    'slug' => 'bahasa-inggris-smp',
                    'topics' => [
                        ['name' => 'Tenses (Simple & Continuous)', 'meta' => '4 sub-topik · 20 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Reading Comprehension',        'meta' => '3 sub-topik · 12 soal', 'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Vocabulary Building',          'meta' => '3 sub-topik · 15 soal', 'diff' => 'easy', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🕌',
                    'title' => 'PAI',
                    'slug' => 'pai-smp',
                    'topics' => [
                        ['name' => 'Akidah & Tauhid', 'meta' => '3 sub-topik · 8 soal',  'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Fiqih Ibadah',    'meta' => '4 sub-topik · 10 soal', 'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Akhlak Mulia',    'meta' => '3 sub-topik · 7 soal',  'diff' => 'easy', 'url' => '#'],
                    ],
                ],
            ],
        ],
        'sma' => [
            'label' => 'SMA',
            'subjects' => [
                [
                    'icon' => '∑',
                    'title' => 'Matematika Wajib',
                    'slug' => 'matematika-sma',
                    'topics' => [
                        ['name' => 'Fungsi Komposisi & Invers', 'meta' => '5 sub-topik · 22 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Limit & Turunan',           'meta' => '6 sub-topik · 28 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Integral',                  'meta' => '5 sub-topik · 25 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Trigonometri',              'meta' => '5 sub-topik · 20 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Statistika & Peluang',      'meta' => '4 sub-topik · 16 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Matriks & Transformasi',    'meta' => '5 sub-topik · 18 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '⚛️',
                    'title' => 'Fisika',
                    'slug' => 'fisika-sma',
                    'topics' => [
                        ['name' => 'Kinematika & Dinamika', 'meta' => '5 sub-topik · 20 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Usaha & Energi',        'meta' => '4 sub-topik · 16 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Listrik Dinamis',       'meta' => '5 sub-topik · 22 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Gelombang & Optik',     'meta' => '4 sub-topik · 15 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Termodinamika',         'meta' => '4 sub-topik · 14 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🧪',
                    'title' => 'Kimia',
                    'slug' => 'kimia-sma',
                    'topics' => [
                        ['name' => 'Struktur Atom & SPU', 'meta' => '4 sub-topik · 16 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Ikatan Kimia',        'meta' => '4 sub-topik · 14 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Stoikiometri',        'meta' => '5 sub-topik · 22 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Asam Basa & Buffer',  'meta' => '4 sub-topik · 18 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🧬',
                    'title' => 'Biologi',
                    'slug' => 'biologi-sma',
                    'topics' => [
                        ['name' => 'Sel & Metabolisme',    'meta' => '5 sub-topik · 18 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Genetika & Hereditas', 'meta' => '5 sub-topik · 20 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Evolusi',              'meta' => '3 sub-topik · 12 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Sistem Organ Manusia', 'meta' => '6 sub-topik · 24 soal', 'diff' => 'mid',  'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🏛️',
                    'title' => 'Sejarah',
                    'slug' => 'sejarah-sma',
                    'topics' => [
                        ['name' => 'Masa Pra-aksara',                  'meta' => '3 sub-topik · 10 soal', 'diff' => 'easy', 'url' => '#'],
                        ['name' => 'Kerajaan Hindu-Buddha-Islam',       'meta' => '5 sub-topik · 18 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Penjajahan & Kebangkitan Nasional', 'meta' => '4 sub-topik · 15 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Kemerdekaan & Orde Baru',          'meta' => '4 sub-topik · 14 soal', 'diff' => 'mid',  'url' => '#'],
                    ],
                ],
                [
                    'icon' => '💰',
                    'title' => 'Ekonomi',
                    'slug' => 'ekonomi-sma',
                    'topics' => [
                        ['name' => 'Permintaan & Penawaran', 'meta' => '4 sub-topik · 14 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Pasar Modal',            'meta' => '3 sub-topik · 10 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Pendapatan Nasional',    'meta' => '4 sub-topik · 12 soal', 'diff' => 'mid',  'url' => '#'],
                    ],
                ],
            ],
        ],
        'kuliah' => [
            'label' => 'Kuliah',
            'subjects' => [
                [
                    'icon' => '💻',
                    'title' => 'Algoritma & Pemrograman',
                    'slug' => 'algoritma-kuliah',
                    'topics' => [
                        ['name' => 'Struktur Data (Array, Linked List)', 'meta' => '5 sub-topik · 25 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Sorting & Searching',               'meta' => '4 sub-topik · 20 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Rekursi & Dynamic Programming',     'meta' => '5 sub-topik · 22 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Graph & Tree',                      'meta' => '5 sub-topik · 20 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Kompleksitas Algoritma (Big-O)',    'meta' => '3 sub-topik · 12 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '📊',
                    'title' => 'Kalkulus',
                    'slug' => 'kalkulus-kuliah',
                    'topics' => [
                        ['name' => 'Limit & Kekontinuan', 'meta' => '4 sub-topik · 20 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Turunan Parsial',     'meta' => '5 sub-topik · 24 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Integral Lipat',      'meta' => '5 sub-topik · 22 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Deret & Barisan',     'meta' => '4 sub-topik · 18 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '📐',
                    'title' => 'Aljabar Linear',
                    'slug' => 'aljabar-kuliah',
                    'topics' => [
                        ['name' => 'Vektor & Ruang Vektor',      'meta' => '5 sub-topik · 20 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Transformasi Linear',        'meta' => '4 sub-topik · 16 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Nilai Eigen & Vektor Eigen', 'meta' => '4 sub-topik · 18 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🧠',
                    'title' => 'Machine Learning',
                    'slug' => 'ml-kuliah',
                    'topics' => [
                        ['name' => 'Regresi Linear & Logistik',    'meta' => '4 sub-topik · 16 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Decision Tree & Random Forest', 'meta' => '4 sub-topik · 14 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Neural Network Dasar',         'meta' => '5 sub-topik · 18 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Evaluasi Model & Overfitting', 'meta' => '3 sub-topik · 12 soal', 'diff' => 'mid',  'url' => '#'],
                    ],
                ],
                [
                    'icon' => '📝',
                    'title' => 'Statistika Inferensial',
                    'slug' => 'statistika-kuliah',
                    'topics' => [
                        ['name' => 'Distribusi Probabilitas', 'meta' => '4 sub-topik · 16 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Uji Hipotesis',           'meta' => '5 sub-topik · 20 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Regresi & Korelasi',      'meta' => '4 sub-topik · 15 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
                [
                    'icon' => '🌐',
                    'title' => 'Jaringan Komputer',
                    'slug' => 'jarkom-kuliah',
                    'topics' => [
                        ['name' => 'Model OSI & TCP/IP',  'meta' => '3 sub-topik · 12 soal', 'diff' => 'mid',  'url' => '#'],
                        ['name' => 'Routing & Switching', 'meta' => '4 sub-topik · 15 soal', 'diff' => 'hard', 'url' => '#'],
                        ['name' => 'Keamanan Jaringan',   'meta' => '4 sub-topik · 14 soal', 'diff' => 'hard', 'url' => '#'],
                    ],
                ],
            ],
        ],
    ];

    return view('student.materi', compact('materiData'));
}

    public function processAi(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'action' => 'required|in:summary,quiz',
        ]);

        try {
            $parser = new Parser();
            
            // Note: Smalot PdfParser only supports PDF. 
            if ($request->file('file')->getClientOriginalExtension() !== 'pdf') {
                throw new \Exception('Maaf, saat ini siPanda baru mendukung file PDF untuk diproses AI.');
            }

            $pdf = $parser->parseFile($request->file('file')->getPathname());
            $text = $pdf->getText();

            if (empty(trim($text))) {
                throw new \Exception('Teks tidak ditemukan dalam file PDF tersebut.');
            }

            $instruction = ($request->action === 'summary') 
                ? "Rangkum teks berikut dengan poin-poin yang mudah dipahami mahasiswa:" 
                : "Buatkan 5 soal pilihan ganda berdasarkan teks berikut lengkap dengan kunci jawabannya:";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'siPanda Learning App',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'openai/gpt-oss-120b:free',
                'messages' => [
                    ['role' => 'system', 'content' => $instruction],
                    ['role' => 'user', 'content' => $text],
                ],
            ]);

            $result = $response->json();
            $aiResult = $result['choices'][0]['message']['content'] ?? 'Gagal memproses.';

            echo $aiResult;

            if ($request->action === 'summary') {
                \App\Models\AiSummary::updateOrCreate(
                    ['user_id' => auth()->id()], 
                    [
                        'summary_text' => $aiResult,
                        'last_generated' => now(),
                    ]
                );
                return back()->with('success', 'Rangkuman berhasil diperbarui!');
            } else {
                return back()->with('quiz_result', $aiResult)
                             ->with('success', 'Soal latihan berhasil dibuat!');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses file: ' . $e->getMessage());
        }
    }

    public function storeLearningSession(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer|min:1',
            // materi_id can be optional or handled if present
            'materi_id' => 'nullable|exists:materis,materi_id'
        ]);

        $duration = $request->input('duration');
        
        \App\Models\LearningSession::create([
            'user_id' => auth()->id(),
            'materi_id' => $request->input('materi_id') ?: 1, // Defaulting to 1 for dummy/general session
            'start_time' => now()->subMinutes($duration),
            'end_time' => now(),
            'duration' => $duration,
            'status' => 'completed',
        ]);

        return response()->json(['success' => true, 'message' => 'Sesi belajar berhasil disimpan!']);
    }
}
