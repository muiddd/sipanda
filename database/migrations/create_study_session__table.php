<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('study_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('subject');       // nama mapel, e.g. "Matematika"
            $table->string('topic')->nullable(); // topik spesifik, e.g. "Kalkulus Integral"
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->unsignedTinyInteger('focus_score')->default(0); // 0-100
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_sessions');
    }
};