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
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onDelete('cascade');
            $table->foreignId('jurusan_id')
                    ->constrained('jurusans')
                    ->onDelete('cascade');
            $table->foreignId('room_id')
                    ->constrained('rooms')
                    ->onDelete('cascade');
            $table->string('nama_siswa');
            $table->string('nisn', 20)->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('telepon', 14);
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
            $table->string('no_hp_ayah', 14)->nullable(); 
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('no_hp_ibu', 14)->nullable();
            $table->enum('gol_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            // Catatan: CHECK constraints untuk format nomor telepon
            // (`telepon` regexp '^08[0-9]{8,12}$', `no_hp_ayah` regexp '^08[0-9]{8,12}$', `no_hp_ibu` regexp '^08[0-9]{8,12}$')
            // tidak dapat langsung diimplementasikan menggunakan metode standar Blueprint
            // di Laravel. Validasi ini sebaiknya ditangani di sisi aplikasi (Laravel validation rules)
            // saat data diterima dari formulir.
            // Jika Anda benar-benar membutuhkan ini di level database, Anda perlu menambahkan
            // DB::statement() di akhir `up()` atau membuat custom migration yang mengeksekusi raw SQL.
            // Contoh (jika dibutuhkan, tapi tidak direkomendasikan untuk portabilitas):
            // DB::statement("ALTER TABLE biodatas ADD CONSTRAINT chk_telepon_format CHECK (telepon REGEXP '^08[0-9]{8,12}$');");
            // DB::statement("ALTER TABLE biodatas ADD CONSTRAINT chk_no_hp_ayah_format CHECK (no_hp_ayah IS NULL OR no_hp_ayah REGEXP '^08[0-9]{8,12}$');");
            // DB::statement("ALTER TABLE biodatas ADD CONSTRAINT chk_no_hp_ibu_format CHECK (no_hp_ibu IS NULL OR no_hp_ibu REGEXP '^08[0-9]{8,12}$');");
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