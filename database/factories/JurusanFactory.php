<?php

namespace Database\Factories;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

class JurusanFactory extends Factory
{
    protected $model = Jurusan::class;

    public function definition(): array
    {
        // Array nama jurusan yang spesifik
        $jurusanNames = [
            'Pengembangan Perangkat Lunak dan Gim',
            'Desain Komunikasi Visual',
            'Teknik Jaringan Komputer dan Telekomunikasi',
            'Manajemen Perkantoran dan Layanan Bisnis',
            'Pemasaran',
            'Animasi',
            'Unit Layanan Pengadaan',
        ];

        // Mengambil satu nama jurusan yang belum pernah digunakan
        static $usedJurusanNames = [];
        $availableJurusanNames = array_diff($jurusanNames, $usedJurusanNames);

        if (empty($availableJurusanNames)) {
            // Reset jika semua nama sudah digunakan (opsional, tergantung berapa banyak Jurusan yang ingin dibuat)
            $usedJurusanNames = [];
            $availableJurusanNames = $jurusanNames;
        }

        $name = $this->faker->unique()->randomElement($availableJurusanNames);
        $usedJurusanNames[] = $name; // Tandai sebagai sudah digunakan

        return [
            'nama_jurusan' => $name,
        ];
    }
}