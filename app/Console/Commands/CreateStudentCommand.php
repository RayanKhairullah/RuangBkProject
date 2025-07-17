<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Room;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateStudentCommand extends Command
{
    protected $signature = 'app:create-student';
    protected $description = 'Creates a student user (requires kode room)';

    public function handle(): int
    {
        $this->line('Create a new student user');
        $name = $this->ask('What is the student\'s name?');
        $email = $this->ask('What is the student\'s email?');
        $password = $this->secret('What is the student\'s password?');
        $kodeRoom = $this->ask('Masukkan kode kelas siswa:');

        $room = Room::where('kode_rooms', $kodeRoom)->first();

        if (! $room) {
            $this->error('Room dengan kode tersebut tidak ditemukan!');
            return CommandAlias::FAILURE;
        }

        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'locale' => 'en',
            'room_id' => $room->id,
        ]);

        $user->assignRole('student');

        $this->info('Student user created successfully.');

        return CommandAlias::SUCCESS;
    }
}