<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $primaryKey = 'materi_id';
    
    protected $fillable = ['judul_materi', 'kategori_id', 'konten_teks', 'tanggal_publikasi', 'admin_id'];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
