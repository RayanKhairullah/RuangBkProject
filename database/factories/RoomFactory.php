<?php

namespace Database\Factories;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jurusan_id' => Jurusan::factory(),
            'kode_rooms' => strtoupper($this->faker->bothify('R###')),
            'tingkatan_rooms' => $this->faker->randomElement(['X', 'XI', 'XII']),
            'angkatan_rooms' => $this->faker->year(),
        ];
    }
}
