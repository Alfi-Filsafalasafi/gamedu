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
        Schema::create('babs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dosen')->constrained('users')->onDelete('cascade');
            $table->integer('index');
            $table->float('beli_point');
            $table->string('nama')->nullable();
            $table->string('durasi')->nullable();
            $table->longText('capaian_pembelajaran')->nullable();
            $table->text('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('babs');
    }
};
