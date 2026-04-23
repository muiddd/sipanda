<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiSummary extends Model
{
    protected $table = 'ai_summaries';
    protected $primaryKey = 'summaries_id';
    protected $fillable = [
        'materi_id',
        'user_id',
        'summary_text',
        'last_generated'
    ];
}
