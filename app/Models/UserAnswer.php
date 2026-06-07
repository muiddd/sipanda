<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $primaryKey = 'answer_id';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function latihan()
    {
        return $this->belongsTo(Latihan::class, 'latihan_id', 'latihan_id');
    }
}
