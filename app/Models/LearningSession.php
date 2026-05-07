<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'user_id',
        'start_time',
        'end_time',
        'duration',
        'status',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id', 'materi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
