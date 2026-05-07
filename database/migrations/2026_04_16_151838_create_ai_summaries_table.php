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
        Schema::create('ai_summaries', function (Blueprint $table) {
            $table->id('summaries_id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('materi_id')->nullable()->constrained('materis', 'materi_id')->onDelete('cascade');
            $table->text('summary_text');
            $table->dateTime('last_generated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_summaries');
    }
};
