<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudySession extends Model
{
    protected $fillable = [
        'user_id',
        'subject',
        'topic',
        'started_at',
        'ended_at',
        'focus_score',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at'   => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Durasi dalam menit
    public function getDurationAttribute(): int
    {
        return (int) $this->started_at->diffInMinutes($this->ended_at);
    }
}