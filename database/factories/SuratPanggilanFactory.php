<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Biodata;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratPanggilan>
 */
class SuratPanggilanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_surat' => 'SP-' . $this->faker->unique()->numerify('####/BK/2025'),
            'tanggal_waktu' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'tempat' => $this->faker->randomElement(['Ruang BK', 'Ruang Kelas', 'Ruang Guru']),
            'tujuan' => $this->faker->sentence(),
            'room_id' => Room::factory(),
            'biodata_id' => Biodata::factory(),
        ];
    }
}
