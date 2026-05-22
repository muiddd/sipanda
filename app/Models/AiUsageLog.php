<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiUsageLog extends Model
{
    protected $fillable = [
        'user_id',
        'materi_id',
        'activity_type',
        'prompt_tokens',
        'completion_tokens',
        'total_tokens',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
