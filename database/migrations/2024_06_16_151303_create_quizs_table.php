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
        Schema::create('quizs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dosen')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_bab')->constrained('babs')->onDelete('cascade');
            $table->enum('type', ['pre-test', 'post-test']);
            $table->text('petunjuk_pengerjaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizs');
    }
};
