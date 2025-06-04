<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        // Pastikan ada Jurusan yang tersedia
        $jurusanId = Jurusan::inRandomOrder()->first()->id ?? Jurusan::factory()->create()->id;

        $tingkatan = $this->faker->randomElement(['X', 'XI', 'XII']);
        $angkatan = $this->faker->numberBetween(2021, 2024); // Sesuaikan rentang angkatan jika perlu

        // Hitung tahun ajaran
        $tahunAjaranMulai = "{$angkatan}-07-01"; // Contoh: dimulai Juli di tahun angkatan
        $tahunAjaranBerakhir = ($angkatan + 2) . '-06-30'; // Berakhir 3 tahun kemudian (angkatan + 2 tahun penuh)

        return [
            'jurusan_id' => $jurusanId,
            'kode_rooms' => $this->generateUniqueKodeRoom(), // Ini akan dibuat unik setelah 'making'
            'tingkatan_rooms' => $tingkatan,
            'angkatan_rooms' => $angkatan,
            'tahun_ajaran_mulai' => $tahunAjaranMulai,
            'tahun_ajaran_berakhir' => $tahunAjaranBerakhir,
        ];
    }

    /**
     * Configure the model factory.
     * Untuk memastikan kode_rooms unik saat di-generate oleh factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Room $room) {
            // Pastikan kode_rooms unik jika belum diset atau jika duplikat
            if (empty($room->kode_rooms) || Room::where('kode_rooms', $room->kode_rooms)->exists()) {
                $room->kode_rooms = $this->generateUniqueKodeRoom();
            }
        });
    }

    /**
     * Helper to generate a unique kode_rooms.
     */
    protected function generateUniqueKodeRoom(): string
    {
        do {
            $code = Str::upper(Str::random(4));
        } while (Room::where('kode_rooms', $code)->exists());
        return $code;
    }
}