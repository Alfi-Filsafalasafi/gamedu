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
        Schema::create('sub_quizs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_quiz')->constrained('quizs')->onDelete('cascade');
            $table->integer('index');
            $table->longText('pertanyaan')->nullable();
            $table->longText('jawaban_a')->nullable();
            $table->longText('jawaban_b')->nullable();
            $table->longText('jawaban_c')->nullable();
            $table->longText('jawaban_d')->nullable();
            $table->longText('jawaban_e')->nullable();
            $table->enum('kunci_jawaban', ['a', 'b', 'c', 'd', 'e'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_quizs');
    }
};
