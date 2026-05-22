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
}
