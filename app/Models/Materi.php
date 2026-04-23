<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['judul', 'kategori_id', 'konten', 'admin_id'];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
