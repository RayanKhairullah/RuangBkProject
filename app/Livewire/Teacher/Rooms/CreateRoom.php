<?php

namespace App\Livewire\Teacher\Rooms;

use App\Models\Jurusan;
use App\Models\Room;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class CreateRoom extends Component
{
    public string $kode_rooms = '';
    public string $tingkatan_rooms = '';
    public string $angkatan_rooms = '';

    // untuk search
    public string $jurusan_search = '';
    public ?int $jurusan_id = null;
    public array $jurusanResults = [];

    #[Layout('components.layouts.teacher')]
    public function mount()
    {
        $this->authorize('create kelas');
        $this->kode_rooms = strtoupper(Str::random(4));
    }

    public function updatedJurusanSearch(string $value)
    {
        $this->jurusanResults = Jurusan::where('nama_jurusan', 'LIKE', "%{$value}%")
            ->limit(5)
            ->pluck('nama_jurusan', 'id')
            ->toArray();
    }

    public function searchJurusan(string $term)
    {
        $this->jurusanResults = Jurusan::where('nama_jurusan', 'LIKE', "%{$term}%")
            ->limit(5)
            ->pluck('nama_jurusan', 'id')
            ->toArray();
    }

    public function selectJurusan(int $id)
    {
        $this->jurusan_id = $id;
        $this->jurusan_search = Jurusan::find($id)->nama_jurusan;
        $this->jurusanResults = [];
    }

    public function save()
    {
        $this->authorize('create kelas');

        $this->validate([
            'kode_rooms'     => 'required|size:4|unique:rooms,kode_rooms',
            'tingkatan_rooms' => 'required|string|min:1|max:3',
            'angkatan_rooms' => 'required',
            'jurusan_id'     => 'required|exists:jurusans,id',
        ]);

        Room::create([
            'kode_rooms'     => $this->kode_rooms,
            'tingkatan_rooms'=> $this->tingkatan_rooms,
            'angkatan_rooms' => $this->angkatan_rooms,
            'jurusan_id'     => $this->jurusan_id,
        ]);

        session()->flash('success', 'Room berhasil dibuat.');
        return redirect()->route('teacher.rooms.index');
    }

    public function render(): View
    {
        return view('livewire.teacher.rooms.rooms-create');
    }
}