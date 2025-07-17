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
        Schema::create('jadwal_konselings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id')->constrained('users');
            $table->foreignId('penerima_id')->constrained('users');
            $table->string('lokasi');
            $table->dateTime('tanggal');
            $table->text('topik_dibahas');
            $table->text('solusi')->nullable();
            $table->enum('status', ['pending','accepted','rejected'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_konselings');
    }
};
