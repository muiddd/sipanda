<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriController extends Controller
{
    public function index()
    {
        $materiGrouped = Materi::with('kategori')
                            ->latest()
                            ->get()
                            ->groupBy(function($item) {
                                return $item->kategori ? $item->kategori->nama_kategori : 'Tanpa Kategori';
                            });

        return view('student.materi', compact('materiGrouped'));
    }

    public function show($id)
    {
        $materi = Materi::where('materi_id', $id)->firstOrFail();
        
        return view('student.ruangbaca', compact('materi'));
    }
}