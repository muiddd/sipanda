<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatSkorController extends Controller
{
    public function index()
    {
        $history = DB::table('user_answers')
            ->join('latihans', 'user_answers.latihan_id', '=', 'latihans.latihan_id')
            ->join('materis', 'latihans.materi_id', '=', 'materis.materi_id')
            ->select([
                'materis.materi_id', 'materis.judul_materi',
                DB::raw('DATE(user_answers.created_at) as attempt_date'),
                DB::raw('COUNT(*) as total_questions'),
                DB::raw('SUM(user_answers.is_correct) as correct_count')
            ])
            ->where('user_answers.user_id', auth()->id())
            ->groupBy('materis.materi_id', 'materis.judul_materi', DB::raw('DATE(user_answers.created_at)'))
            ->orderByDesc('attempt_date')
            ->get()
            ->map(function ($row) {
                $row->score = $row->total_questions ? round(($row->correct_count / $row->total_questions) * 100, 2) : 0;
                return $row;
            });

        return view('student.riwayatskor', compact('history'));
    }

    public function show(Request $request, $materi, $date)
    {
        $rows = DB::table('user_answers')
            ->join('latihans', 'user_answers.latihan_id', '=', 'latihans.latihan_id')
            ->where('user_answers.user_id', auth()->id())
            ->where('latihans.materi_id', $materi)
            ->whereDate('user_answers.created_at', $date)
            ->select('latihans.latihan_id', 'latihans.question', 'latihans.options', 'user_answers.answer', 'user_answers.is_correct')
            ->orderBy('user_answers.created_at')
            ->get();

        $items = $rows->map(function ($r) {
            $options = is_string($r->options) ? json_decode($r->options, true) : $r->options;
            $pilihan = $options['pilihan'] ?? [];
            $correct_letter = $options['jawaban_benar'] ? substr(trim($options['jawaban_benar']), 0, 1) : null;

            $getText = function ($letter) use ($pilihan) {
                return collect($pilihan)->first(fn($opt) => trim(substr($opt, 0, 1)) === $letter);
            };

            return [
                'latihan_id'         => $r->latihan_id,
                'question'           => $r->question,
                'options'            => $pilihan,
                'user_answer_letter' => $r->answer,
                'user_answer_text'   => $getText($r->answer),
                'correct_letter'     => $correct_letter,
                'correct_text'       => $getText($correct_letter),
                'is_correct'         => (bool) $r->is_correct,
            ];
        });

        return response()->json(['status' => 'success', 'data' => $items]);
    }
}