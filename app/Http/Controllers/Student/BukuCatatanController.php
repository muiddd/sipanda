<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\BukuCatatan;
use App\Models\AiSummary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BukuCatatanController extends Controller
{
    // ==========================================
    // INDEX — Tampilkan semua buku catatan user
    // ==========================================
    public function index(Request $request)
    {
        $userId = auth()->id();

        // Ambil semua nama buku unik milik user
        $daftarBuku = BukuCatatan::forUser($userId)
            ->selectRaw('nama_buku, COUNT(*) as jumlah_catatan, MAX(updated_at) as terakhir_diupdate')
            ->groupBy('nama_buku')
            ->orderByDesc('terakhir_diupdate')
            ->get();

        // Statistik header
        $totalBuku      = $daftarBuku->count();
        $totalCatatan   = BukuCatatan::forUser($userId)->count();
        $totalDariAi    = BukuCatatan::forUser($userId)->where('tipe', 'AI')->count();
        $hariIni        = BukuCatatan::forUser($userId)
            ->whereDate('updated_at', today())
            ->count();

        // Catatan yang sedang dipilih (untuk panel kanan)
        $selectedBuku   = $request->query('buku', optional($daftarBuku->first())->nama_buku);
        $catatan        = BukuCatatan::forUser($userId)
            ->byBuku($selectedBuku)
            ->orderByDesc('created_at')
            ->get();

        // Catatan pertama untuk ditampilkan di panel detail
        $selectedCatatan = $catatan->first();
        if ($request->query('catatan_id')) {
            $selectedCatatan = $catatan->firstWhere('catatan_id', $request->query('catatan_id'));
        }

        return view('student.bukuCatatan', compact(
            'daftarBuku',
            'catatan',
            'selectedBuku',
            'selectedCatatan',
            'totalBuku',
            'totalCatatan',
            'totalDariAi',
            'hariIni'
        ));
    }

    // ==========================================
    // EXPORT — Simpan ringkasan AI ke Buku Catatan
    // ==========================================
    public function exportFromAi(Request $request)
    {
        $request->validate([
            'summaries_id' => 'required|exists:ai_summaries,summaries_id',
            'judul'        => 'required|string|max:255',
            'nama_buku'    => 'required|string|max:100',
            'tags'         => 'nullable|string',
        ]);

        $summary = AiSummary::where('summaries_id', $request->summaries_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Parse tags dari input (comma-separated)
        $tags = [];
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tags = array_filter($tags);
            $tags = array_values($tags);
        }

        // Tentukan sumber otomatis
        $sumber = 'Diekspor dari ringkasan AI';
        if ($summary->materi) {
            $sumber = 'Diekspor dari ringkasan AI materi ' . $summary->materi->judul;
        }

        BukuCatatan::create([
            'user_id'      => auth()->id(),
            'summaries_id' => $summary->summaries_id,
            'materi_id'    => $summary->materi_id,
            'judul'        => $request->judul,
            'isi'          => $summary->summary_text,
            'tipe'         => 'AI',
            'nama_buku'    => $request->nama_buku,
            'tags'         => $tags,
            'sumber'       => $sumber,
        ]);

        return redirect()->route('student.bukucatatan')
            ->with('success', 'Ringkasan AI berhasil diekspor ke Buku Catatan!');
    }

    // ==========================================
    // STORE — Simpan catatan manual baru
    // ==========================================
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'isi'       => 'required|string',
            'nama_buku' => 'required|string|max:100',
            'tags'      => 'nullable|string',
            'tipe'      => 'in:Manual,Highlight,AI',
        ]);

        $tags = [];
        if ($request->filled('tags')) {
            $tags = array_values(array_filter(array_map('trim', explode(',', $request->tags))));
        }

        BukuCatatan::create([
            'user_id'    => auth()->id(),
            'judul'      => $request->judul,
            'isi'        => $request->isi,
            'tipe'       => $request->tipe ?? 'Manual',
            'nama_buku'  => $request->nama_buku,
            'tags'       => $tags,
            'is_penting' => $request->boolean('is_penting'),
        ]);

        return redirect()->route('student.bukucatatan', ['buku' => $request->nama_buku])
            ->with('success', 'Catatan berhasil ditambahkan!');
    }

    // ==========================================
    // DESTROY — Hapus catatan
    // ==========================================
    public function destroy($id)
    {
        $catatan = BukuCatatan::where('catatan_id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $namaBuku = $catatan->nama_buku;
        $catatan->delete();

        return redirect()->route('student.bukucatatan', ['buku' => $namaBuku])
            ->with('success', 'Catatan berhasil dihapus.');
    }
}
