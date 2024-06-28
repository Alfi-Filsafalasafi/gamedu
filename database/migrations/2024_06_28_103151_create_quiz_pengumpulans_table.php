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
        Schema::create('quiz_pengumpulans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_quiz')->constrained('quizs')->onDelete('cascade');
            $table->foreignId('id_pertanyaan')->constrained('sub_quizs')->onDelete('cascade');
            $table->enum('jawaban', ['a', 'b', 'c', 'd', 'e'])->nullable();
            $table->tinyInteger('is_benar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_pengumpulans');
    }
};
