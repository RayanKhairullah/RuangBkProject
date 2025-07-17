<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatatanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'guru_id' => User::factory(),
            'tanggal' => $this->faker->date(),
            'masalah_dibahas' => $this->faker->sentence(),
            'tindak_lanjut' => $this->faker->optional()->sentence(),
            'hasil_akhir' => $this->faker->optional()->sentence(),
            'poin' => $this->faker->numberBetween(0, 100),
        ];
    }
}