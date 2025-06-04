<?php

namespace Database\Factories;

use App\Models\Catatan;
use App\Models\User;
use App\Models\Room;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatatanFactory extends Factory
{
    protected $model = Catatan::class;

    public function definition(): array
    {
        // Ensure a teacher and a student user exist
        $teacher = User::where('role', UserRole::Teacher)->inRandomOrder()->first();
        if (!$teacher) {
            $teacher = User::factory()->teacher()->create();
        }

        $student = User::where('role', UserRole::User)->inRandomOrder()->first();
        if (!$student) {
            $student = User::factory()->create();
        }

        // Get the room based on the student's kode_rooms
        $room = Room::where('kode_rooms', $student->kode_rooms)->first();
        if (!$room) {
            // Fallback: if student's room doesn't exist, create a new room and assign to student
            $room = Room::factory()->create();
            $student->update(['kode_rooms' => $room->kode_rooms]);
        }

        return [
            'user_id' => $student->id,
            'room_id' => $room->id,
            'guru_id' => $teacher->id,
            'kasus' => $this->faker->sentence(),
            'tanggal' => $this->faker->date(),
            'catatan_guru' => $this->faker->paragraph(),
            'poin' => $this->faker->numberBetween(1, 127), // <--- UBAH INI MENJADI 127
            'nama_siswa' => $student->name,
            'guru_pembimbing' => $teacher->name,
        ];
    }
}