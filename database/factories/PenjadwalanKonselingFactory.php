<?php

namespace Database\Factories;

use App\Models\PenjadwalanKonseling;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjadwalanKonselingFactory extends Factory
{
    protected $model = PenjadwalanKonseling::class;

    public function definition(): array
    {
        // Pastikan ada user siswa (role: User)
        $student = User::where('role', UserRole::User)->inRandomOrder()->first();
        if (!$student) {
            // Fallback: jika tidak ada siswa, buat satu.
            $student = User::factory()->create(['role' => UserRole::User]);
        }

        // Pastikan ada user guru (role: Teacher)
        $teacher = User::where('role', UserRole::Teacher)->inRandomOrder()->first();
        if (!$teacher) {
            // Fallback: jika tidak ada guru, buat satu.
            $teacher = User::factory()->teacher()->create();
        }

        return [
            'pengirim_id' => $student->id, // Siswa adalah pengirim
            'penerima_id' => $teacher->id, // Guru adalah penerima
            'lokasi' => $this->faker->randomElement(['Ruang BK', 'Online Via Google Meet', 'Kantor Guru', 'Perpustakaan']),
            'tanggal' => $this->faker->dateTimeBetween('now', '+3 months'), // Tanggal di masa depan
            'topik_dibahas' => $this->faker->sentence(5, true),
            'solusi' => $this->faker->boolean(70) ? $this->faker->paragraph(2, true) : null,
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'nama_pengirim' => $student->name, // Nama siswa pengirim
            'nama_penerima' => $teacher->name, // Nama guru penerima
        ];
    }
}