<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;

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

        $favoriteMateriIds = auth()->user()
                            ->favoriteMateris()
                            ->pluck('user_favorite_materis.materi_id')
                            ->toArray();

        return view('student.materi', compact('materiGrouped', 'favoriteMateriIds'));
    }

    public function show($id)
    {
        $materi = Materi::where('materi_id', $id)->firstOrFail();
        
        return view('student.ruangbaca', compact('materi'));
    }

    
    public function toggleFavorite(Request $request, $id)
    {
        $materi = Materi::where('materi_id', $id)->firstOrFail();
        $user = auth()->user();

        if ($user->favoriteMateris()->where('materis.materi_id', $materi->materi_id)->exists()) {
            $user->favoriteMateris()->detach($materi->materi_id);
            $favorite = false;
        } else {
            $user->favoriteMateris()->attach($materi->materi_id);
            $favorite = true;
        }

        return response()->json([
            'favorite' => $favorite,
            'materi_id' => $materi->materi_id,
        ]);
    }
    }