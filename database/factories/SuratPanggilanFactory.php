<?php

namespace Database\Factories;

use App\Models\SuratPanggilan;
use App\Models\Room;
use App\Models\User; // Mungkin dibutuhkan untuk mendapatkan nama siswa, tapi tidak langsung digunakan di sini
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SuratPanggilanFactory extends Factory
{
    protected $model = SuratPanggilan::class;

    public function definition(): array
    {
        // Pastikan ada Room yang sudah ada
        $room = Room::inRandomOrder()->first();
        if (!$room) {
            // Jika tidak ada Room, buat satu sebagai fallback
            $room = Room::factory()->create();
        }

        // Ambil nama siswa dari salah satu user dengan role 'User' (siswa)
        // Atau Anda bisa generate nama random jika tidak ingin terikat dengan tabel users
        $studentUser = User::where('role', \App\Enums\UserRole::User)->inRandomOrder()->first();
        $namaSiswa = $studentUser ? $studentUser->name : $this->faker->name(); // Fallback jika tidak ada user siswa

        return [
            'nomor_surat' => $this->generateUniqueNomorSurat(),
            'tanggal_waktu' => $this->faker->dateTimeBetween('-1 month', '+3 months'),
            'tempat' => $this->faker->city . ' - ' . $this->faker->streetAddress,
            'tujuan' => $this->faker->paragraph(2),
            'nama_siswa' => $namaSiswa,
            'room_id' => $room->id,
            // Jika Anda menambahkan kolom 'detail_room' di DB:
            // 'detail_room' => $room->kode_rooms . ' - ' . $room->jurusan->nama_jurusan . ' - ' . $room->tingkatan_rooms,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (SuratPanggilan $suratPanggilan) {
            // Pastikan nomor_surat unik jika belum diset atau jika duplikat
            if (empty($suratPanggilan->nomor_surat) || SuratPanggilan::where('nomor_surat', $suratPanggilan->nomor_surat)->exists()) {
                $suratPanggilan->nomor_surat = $this->generateUniqueNomorSurat();
            }
        });
    }

    /**
     * Helper to generate a unique nomor_surat.
     */
    protected function generateUniqueNomorSurat(): string
    {
        do {
            // Contoh format: SP/YYMM/XXX/BK
            $nomor = 'SP/' . date('ym') . '/' . $this->faker->unique()->numberBetween(100, 999) . '/BK';
        } while (SuratPanggilan::where('nomor_surat', $nomor)->exists());
        return $nomor;
    }
}