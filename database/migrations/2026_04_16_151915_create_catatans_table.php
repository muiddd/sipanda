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
        Schema::create('buku_catatan', function (Blueprint $table) {
            $table->id('catatan_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('summaries_id')->nullable()->constrained('ai_summaries', 'summaries_id')->onDelete('set null');
            $table->foreignId('materi_id')->nullable()->constrained('materis', 'materi_id')->onDelete('set null');
            $table->string('judul');
            $table->text('isi');
            $table->string('tipe')->default('AI'); 
            $table->string('nama_buku')->nullable(); 
            $table->json('tags')->nullable();
            $table->string('sumber')->nullable();
            $table->boolean('is_penting')->default(false);
            $table->timestamps();
        });
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_catatan');
    }
};
