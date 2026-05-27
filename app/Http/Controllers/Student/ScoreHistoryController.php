<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreHistoryController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();

        // Group user answers by materi and attempt date (date only)
        $history = DB::table('user_answers')
            ->join('latihans', 'user_answers.latihan_id', '=', 'latihans.latihan_id')
            ->join('materis', 'latihans.materi_id', '=', 'materis.materi_id')
            ->select(
                'materis.materi_id',
                'materis.judul_materi',
                DB::raw('DATE(user_answers.created_at) as attempt_date'),
                DB::raw('COUNT(*) as total_questions'),
                DB::raw('SUM(CASE WHEN user_answers.is_correct = 1 THEN 1 ELSE 0 END) as correct_count')
            )
            ->where('user_answers.user_id', $userId)
            ->groupBy('materis.materi_id', 'materis.judul_materi', DB::raw('DATE(user_answers.created_at)'))
            ->orderByDesc('attempt_date')
            ->get()
            ->map(function ($row) {
                $row->score = $row->total_questions ? round(($row->correct_count / $row->total_questions) * 100, 2) : 0;
                return $row;
            });

        return view('student.riwayatskor', compact('history'));
    }

    /**
     * Return detailed answers for a materi on a specific date (JSON for AJAX)
     */
    public function show(Request $request, $materi, $date)
    {
        $userId = auth()->id();

        $rows = DB::table('user_answers')
            ->join('latihans', 'user_answers.latihan_id', '=', 'latihans.latihan_id')
            ->where('user_answers.user_id', $userId)
            ->where('latihans.materi_id', $materi)
            ->whereDate('user_answers.created_at', $date)
            ->select('latihans.latihan_id', 'latihans.question', 'latihans.options', 'user_answers.answer', 'user_answers.is_correct')
            ->orderBy('user_answers.created_at')
            ->get();

        $items = $rows->map(function ($r) {
            $options = is_string($r->options) ? json_decode($r->options, true) : $r->options;
            $pilihan = $options['pilihan'] ?? [];
            $jawaban_benar = $options['jawaban_benar'] ?? null;
            $correct_letter = $jawaban_benar ? substr(trim($jawaban_benar), 0, 1) : null;
            $user_letter = $r->answer;

            $getText = function ($letter) use ($pilihan) {
                foreach ($pilihan as $opt) {
                    if (trim(substr($opt, 0, 1)) == $letter) return $opt;
                }
                return null;
            };

            return [
                'latihan_id' => $r->latihan_id,
                'question' => $r->question,
                'options' => $pilihan,
                'user_answer_letter' => $user_letter,
                'user_answer_text' => $getText($user_letter),
                'correct_letter' => $correct_letter,
                'correct_text' => $getText($correct_letter),
                'is_correct' => (bool) $r->is_correct,
            ];
        });

        return response()->json(['status' => 'success', 'data' => $items]);
    }
}
