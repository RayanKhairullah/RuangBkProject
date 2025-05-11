<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room;
use App\Models\Jurusan;

class RoomFilter extends Component
{
    use WithPagination;

    public $jurusan = '';
    public $tingkatan = '';

    protected $queryString = ['jurusan', 'tingkatan'];

    public function updatingJurusan()
    {
        $this->resetPage();
    }

    public function updatingTingkatan()
    {
        $this->resetPage();
    }

    public function render()
    {
        $jurusans = Jurusan::all();

        $rooms = Room::with('jurusan')
            ->when($this->jurusan, function ($query) {
                $query->where('jurusan_id', $this->jurusan);
            })
            ->when($this->tingkatan, function ($query) {
                $query->where('tingkatan_rooms', $this->tingkatan);
            })
            ->paginate(10);

        return view('livewire.room-filter', [
            'rooms' => $rooms,
            'jurusans' => $jurusans,
        ]);
    }
}