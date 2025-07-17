<?php

namespace App\Livewire\Teacher\Rooms;

use App\Models\Room;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewRoom extends Component
{
    public Room $room;

    public function mount(Room $room)
    {
        $this->authorize('view kelas');
        $this->room = $room->load(['jurusan', 'users.biodata']);
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        return view('livewire.teacher.rooms.rooms-view', [
            'room' => $this->room,
        ]);
    }
}