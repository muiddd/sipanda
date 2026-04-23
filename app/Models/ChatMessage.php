<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChatMessage extends Model
{

    protected $fillable = [
        'user_id',    // Pastikan ini ada
        'question',
        'answer',
    ];
}
