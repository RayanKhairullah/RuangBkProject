<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalKonseling>
 */
class JadwalKonselingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pengirim_id' => User::factory(),
            'penerima_id' => User::factory(),
            'lokasi' => $this->faker->randomElement(['Ruang BK', 'Ruang Kelas', 'Ruang Guru']),
            'tanggal' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'topik_dibahas' => $this->faker->sentence(),
            'solusi' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['pending','accepted','rejected']),
            'alasan_penolakan' => $this->faker->optional()->sentence(),
        ];
    }
}
