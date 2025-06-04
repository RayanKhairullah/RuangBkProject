<?php

namespace Database\Factories;

use App\Models\Biodata;
use App\Models\User;
use App\Models\Room;
use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

class BiodataFactory extends Factory
{
    protected $model = Biodata::class;

    public function definition(): array
    {
        // Ensure a User (student) exists and has a room
        $user = User::where('role', \App\Enums\UserRole::User)->inRandomOrder()->first();
        if (!$user) {
            // If no student user exists, create one.
            $user = User::factory()->create(['role' => \App\Enums\UserRole::User]);
        }

        // Get the room and jurusan based on the user's kode_rooms
        $room = Room::where('kode_rooms', $user->kode_rooms)->first();
        if (!$room) {
            // Fallback: if user's room doesn't exist, create a new room and assign to user
            $room = Room::factory()->create();
            $user->update(['kode_rooms' => $room->kode_rooms]);
        }
        $jurusan = $room->jurusan; // Assuming Room model has a 'jurusan' relationship

        // Helper to generate phone numbers matching the regex ^08[0-9]{8,12}$
        $generatePhoneNumber = function () {
            return '08' . $this->faker->numerify('##########'); // 10 digits after 08
        };

        return [
            'user_id' => $user->id,
            'nama_siswa' => $user->name, // Use user's name for consistency
            'nisn' => $this->faker->unique()->numerify('############'), // 12 digit NISN
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'jurusan_id' => $jurusan->id,
            'room_id' => $room->id,
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'telepon' => $generatePhoneNumber(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha', 'Lainnya']),
            'alamat_ktp' => $this->faker->address(),
            'alamat_domisili' => $this->faker->boolean(50) ? $this->faker->address() : null, // 50% chance to be different
            'cita_cita' => $this->faker->boolean(70) ? $this->faker->jobTitle() : null,
            'hobi' => $this->faker->boolean(70) ? $this->faker->words(2, true) : null,
            'minat_bakat' => $this->faker->boolean(50) ? $this->faker->sentence() : null,
            'sd' => $this->faker->boolean(80) ? 'SD ' . $this->faker->city() : null,
            'smp' => $this->faker->boolean(80) ? 'SMP ' . $this->faker->city() : null,
            'sma' => $this->faker->boolean(80) ? 'SMA ' . $this->faker->city() : null,
            'nama_ayah' => $this->faker->name('male'),
            'pekerjaan_ayah' => $this->faker->jobTitle(),
            'no_hp_ayah' => $generatePhoneNumber(),
            'nama_ibu' => $this->faker->name('female'),
            'pekerjaan_ibu' => $this->faker->jobTitle(),
            'no_hp_ibu' => $generatePhoneNumber(),
            'gol_darah' => $this->faker->boolean(70) ? $this->faker->randomElement(['A', 'B', 'AB', 'O']) : null,
            'status' => $this->faker->randomElement(['Pelajar', 'Mahasiswa', 'Bekerja']),
            'image' => null, // For simplicity, no image upload in factory
        ];
    }
}