<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateTeacherCommand extends Command
{
    protected $signature = 'app:create-teacher';
    protected $description = 'Creates a teacher user';

    public function handle(): int
    {
        $this->line('Create a new teacher user');
        $name = $this->ask('What is the teacher\'s name?');
        $email = $this->ask('What is the teacher\'s email?');
        $password = $this->secret('What is the teacher\'s password?');

        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'locale' => 'en',
        ]);

        $user->assignRole('teacher');

        $this->info('Teacher user created successfully.');

        return CommandAlias::SUCCESS;
    }
}