<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Room;
use App\Models\Jurusan;

class RoomTable extends Component
{
    use WithPagination;

    // properti untuk filter
    public $searchTingkatan = ''; // Ganti dari searchKode ke searchTingkatan
    public $searchJurusan = '';
    public $perPage = 10;

    // reset pagination saat properti filter di-update
    protected function updatingSearchTingkatan()
    {
        $this->resetPage();
    }

    protected function updatingSearchJurusan()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Room::with('jurusan')
            ->when($this->searchTingkatan, function ($q) {
                $q->where('tingkatan_rooms', 'like', '%'.$this->searchTingkatan.'%'); // Filter berdasarkan tingkatan
            })
            ->when($this->searchJurusan, function ($q) {
                $q->whereHas('jurusan', function ($q2) {
                    $q2->where('nama_jurusan', 'like', '%'.$this->searchJurusan.'%');
                });
            });

        return view('livewire.room-table', [
            'rooms' => $query->paginate($this->perPage),
        ]);
    }
}