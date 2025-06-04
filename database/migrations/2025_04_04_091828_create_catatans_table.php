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
            $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('cascade');
            $table->foreignId('room_id')
                    ->constrained('rooms')
                    ->onDelete('cascade');
            $table->foreignId('guru_id')
                    ->constrained('users') 
                    ->onDelete('cascade');
            $table->string('kasus');
            $table->date('tanggal');
            $table->text('catatan_guru');
            $table->tinyInteger('poin'); 
            $table->timestamps();
            $table->string('nama_siswa')->default('siswa smea')->after('updated_at');
            $table->string('guru_pembimbing')->default('guru smea')->after('nama_siswa'); 
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('catatans');
    }
};
