<?php

namespace App\Livewire\Teacher;

use App\Models\Room;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Session;

class Rooms extends Component
{
    use WithPagination, LivewireAlert;

    #[Session]
    public int $perPage = 10;

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $this->authorize('view kelas');

        $rooms = Room::query()
            ->with('jurusan')
            ->when($this->search, fn($q) =>
                $q->where('kode_rooms','like',"%{$this->search}%")
                    ->orWhere('tingkatan_rooms','like',"%{$this->search}%")
                    ->orWhere('angkatan_rooms','like',"%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.teacher.rooms', compact('rooms'));
    }

    public function deleteRoom($id)
    {
        $this->authorize('delete kelas');
        $room = Room::findOrFail($id);
        $room->delete();
        $this->alert('success', 'Room berhasil dihapus.');
    }
}