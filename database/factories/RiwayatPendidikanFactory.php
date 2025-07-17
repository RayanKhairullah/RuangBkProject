<?php

namespace Database\Factories;

use App\Models\Biodata;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RiwayatPendidikan>
 */
class RiwayatPendidikanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'biodata_id' => Biodata::factory(),
            'tingkat' => $this->faker->randomElement(['SD','SMP','SMA']),
            'nama_sekolah' => $this->faker->company() . ' School',
        ];
    }
}
