<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->nullable()->default('siswa smea'); // Relasi ke tabel users (siswa)
            $table->string('nama_siswa');
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // Relasi ke tabel rooms
            $table->foreignId('guru_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (guru)
            $table->string('guru_pembimbing');
            $table->string('kasus');
            $table->date('tanggal');
            $table->text('catatan_guru');
            $table->unsignedTinyInteger('poin')->check('poin >= 1 AND poin <= 150');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('catatans');
    }
};
