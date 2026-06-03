<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_favorite_materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('materi_id')->constrained('materis', 'materi_id')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'materi_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_favorite_materis');
    }
};
