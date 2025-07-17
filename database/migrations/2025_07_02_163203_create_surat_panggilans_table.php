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
        Schema::create('surat_panggilans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->dateTime('tanggal_waktu');
            $table->string('tempat');
            $table->text('tujuan');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('biodata_id')->constrained('biodatas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_panggilans');
    }
};
