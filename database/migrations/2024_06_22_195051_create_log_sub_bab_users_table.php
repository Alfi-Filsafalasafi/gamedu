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
        Schema::create('log_sub_bab_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_bab')->constrained('babs')->onDelete('cascade');
            $table->foreignId('id_sub_bab')->constrained('sub_babs')->onDelete('cascade');
            $table->enum('status', ['belumAda', 'progress', 'selesai'])->nullable();
            $table->float('point_membaca')->nullable();
            $table->float('point_menonton_yt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_sub_bab_users');
    }
};
