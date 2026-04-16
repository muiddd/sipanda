<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('latihans', function (Blueprint $table) {
            $table->id('latihan_id');
            $table->foreignId('materi_id')->constrained('materis', 'materi_id')->onDelete('cascade');
            $table->text('question');
            $table->json('options'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihans');
    }
};
