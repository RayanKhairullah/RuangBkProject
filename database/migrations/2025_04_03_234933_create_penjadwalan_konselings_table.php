<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjadwalan_konselings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id')
                    ->constrained('users')
                    ->onDelete('cascade');
            $table->foreignId('penerima_id')
                    ->constrained('users')
                    ->onDelete('cascade');
            $table->string('lokasi');
            $table->dateTime('tanggal');
            $table->text('topik_dibahas');
            $table->text('solusi')->nullable();
            $table->enum('status', ['pending','accepted','rejected'])->default('pending');
            $table->timestamps();
            $table->string('nama_pengirim')->default('guru smea')->after('updated_at');
            $table->string('nama_penerima')->default('siswa smea')->after('nama_pengirim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjadwalan_konselings');
    }
};