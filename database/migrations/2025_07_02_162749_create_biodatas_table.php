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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->string('nisn', 20);
            $table->foreignId('jurusan_id')->constrained('jurusans');
            $table->foreignId('room_id')->constrained('rooms');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('telepon', 14);
            $table->enum('agama', ['Islam','Kristen','Hindu','Budha','Islam', 'Kristen', 'Hindu', 'Buddha', 'Konghucu']);
            $table->text('alamat_ktp');
            $table->text('alamat_domisili')->nullable();
            $table->string('cita_cita')->nullable();
            $table->string('hobi')->nullable();
            $table->text('minat_bakat')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('no_hp_ayah', 14)->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ibu', 14)->nullable();
            $table->enum('gol_darah', ['A','B','AB','O'])->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
