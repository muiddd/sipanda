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
        Schema::create('materis', function (Blueprint $table) {
            $table->id('materi_id'); // Primary Key 
            $table->foreignId('kategori_id')->references('kategori_id')->on('kategoris');
            $table->foreignId('admin_id')->references('id')->on('users');
            $table->string('judul_materi');
            $table->text('konten_teks');
            $table->dateTime('tanggal_publikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
