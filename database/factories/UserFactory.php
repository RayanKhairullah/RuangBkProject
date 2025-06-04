<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Room; // Import Room model
use App\Enums\UserRole; // Import UserRole enum
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        // Ensure a room exists for students. For teachers, a fixed code is used.
        $room = Room::inRandomOrder()->first();
        if (!$room) {
            $room = Room::factory()->create();
        }

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // default password
            'remember_token' => Str::random(10),
            'role' => UserRole::User, // Default role is 'user'
            'kode_rooms' => $room->kode_rooms,
        ];
    }

    // State for teacher role
    public function teacher(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => UserRole::Teacher,
                'kode_rooms' => 'TCHR', // Fixed code for teachers, as per your schema (NOT NULL)
            ];
        });
    }

    // State for unverified email
    public function unverified(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}