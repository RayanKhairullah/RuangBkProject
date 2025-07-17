<?php

namespace App\Livewire\Teacher\Rooms;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ViewBiodata extends Component
{
    public ?User $user = null;

    #[Layout('components.layouts.teacher')]
    public function mount(): void
    {
        $this->authorize('view biodata student');

        $userId = request()->query('user_id');
        $this->user = User::with('biodata')->findOrFail($userId);
    }

    public function render(): View
    {
        return view('livewire.teacher.rooms.biodatas-view', [
            'biodata' => $this->user->biodata,
            'user' => $this->user,
        ]);
    }
}