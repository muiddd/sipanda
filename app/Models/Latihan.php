<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    protected $primaryKey = 'latihan_id';
    
    protected $guarded = [];
    
    protected $casts = [
        'options' => 'array',
    ];
}
