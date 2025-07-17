<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';
    public string $kode_rooms = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'kode_rooms' => ['required', 'string', 'size:4', 'alpha_num', 'exists:rooms,kode_rooms'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Cari room_id berdasarkan kode_rooms
        $room = \App\Models\Room::where('kode_rooms', $validated['kode_rooms'])->first();
        $validated['room_id'] = $room->id;

        unset($validated['kode_rooms']);

        event(new Registered(($user = User::create($validated))));

        $user->assignRole('student');

        Auth::login($user);

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }
}
