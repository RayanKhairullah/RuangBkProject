<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biodatas
        ', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onDelete('cascade');

            // Data siswa dasar
            $table->string('nama_siswa');
            $table->unsignedBigInteger('nisn')->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);

            $table->foreignId('jurusan_id')
                    ->constrained('jurusans')
                    ->onDelete('cascade');

            $table->foreignId('room_id')
                    ->constrained('rooms')
                    ->onDelete('cascade');

            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('telepon'); // Removed the check constraint here
            $table->enum('agama', ['Islam', 'Kristen', 'Hindu', 'Budha', 'Lainnya']);

            $table->text('alamat_ktp');
            $table->text('alamat_domisili')->nullable()->comment('Isi jika beda dengan alamat KTP');

            $table->string('cita_cita')->nullable();
            $table->string('hobi')->nullable();
            $table->text('minat_bakat')->nullable();

            $table->string('sd')->nullable();
            $table->string('smp')->nullable();
            $table->string('sma')->nullable();

            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('no_hp_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ibu')->nullable();

            $table->enum('gol_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('status')->nullable();

            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biodatas
        ');
    }
};