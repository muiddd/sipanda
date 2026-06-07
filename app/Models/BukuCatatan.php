<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuCatatan extends Model
{
    use HasFactory;

    protected $table = 'buku_catatan';
    protected $primaryKey = 'catatan_id';

    protected $fillable = [
        'user_id',
        'summaries_id',
        'materi_id',
        'judul',
        'isi',
        'tipe',
        'nama_buku',
        'tags',
        'sumber',
        'is_penting',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_penting' => 'boolean',
    ];

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function summary()
    {
        return $this->belongsTo(AiSummary::class, 'summaries_id', 'summaries_id');
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'materi_id');
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByBuku($query, $namaBuku)
    {
        return $query->where('nama_buku', $namaBuku);
    }
}