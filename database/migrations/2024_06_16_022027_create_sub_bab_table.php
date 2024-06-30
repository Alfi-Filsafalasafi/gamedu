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
        Schema::create('sub_babs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_bab')->constrained('babs')->onDelete('cascade');
            $table->integer('index');
            $table->float('beli_point');
            $table->string('nama');
            $table->longText('content')->nullable();
            $table->longText('uraian_tugas')->nullable();
            $table->longText('rublik_penilaian')->nullable();
            $table->text('link_yt')->nullable();
            $table->float('point_membaca');
            $table->float('point_menonton_yt')->nullable();
            $table->float('point_tugas');
            $table->float('bintang_1');
            $table->float('bintang_2');
            $table->float('bintang_3');
            $table->float('min_akses_materi');
            $table->float('min_akses_yt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_babs');
    }
};
