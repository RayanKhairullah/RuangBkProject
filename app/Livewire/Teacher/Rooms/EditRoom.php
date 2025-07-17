<?php

namespace App\Livewire\Teacher\Rooms;

use App\Models\Room;
use App\Models\Jurusan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditRoom extends Component
{
    public Room $room;
    public string $kode_rooms;
    public string $tingkatan_rooms;
    public string $angkatan_rooms;
    public string $jurusan_search = '';
    public $jurusan_id;
    public array $jurusanResults = [];

    public function mount(Room $room)
    {
        $this->authorize('update kelas');
        $this->room = $room;
        $this->kode_rooms      = $room->kode_rooms;
        $this->tingkatan_rooms = $room->tingkatan_rooms;
        $this->angkatan_rooms  = $room->angkatan_rooms;
        $this->jurusan_id      = $room->jurusan_id;
        $this->jurusan_search  = optional($room->jurusan)->nama_jurusan;
    }

    // Method pencarian (boleh dipanggil manual)
    public function searchJurusan(string $term)
    {
        $this->jurusanResults = Jurusan::where('nama_jurusan', 'LIKE', "%{$term}%")
            ->limit(5)
            ->pluck('nama_jurusan', 'id')
            ->toArray();
    }

    // Method pilih jurusan
    public function selectJurusan(int $id)
    {
        $this->jurusan_id     = $id;
        $this->jurusan_search = Jurusan::findOrFail($id)->nama_jurusan;
        $this->jurusanResults = [];
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $jurusans = Jurusan::all();
        return view('livewire.teacher.rooms.rooms-edit', compact('jurusans'));
    }

    public function updatedTingkatanRooms($value)
    {
        $this->tingkatan_rooms = substr(preg_replace('/[^A-Za-z0-9]/', '', $value), 0, 3);
    }

    public function update()
    {
        $this->authorize('update kelas');
        $this->validate([
            'kode_rooms' => 'required|size:4|unique:rooms,kode_rooms,' . $this->room->id,
            'tingkatan_rooms' => 'required|string|min:1|max:3',
            'angkatan_rooms' => 'required',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $this->room->update([
            'kode_rooms' => $this->kode_rooms,
            'tingkatan_rooms' => $this->tingkatan_rooms,
            'angkatan_rooms' => $this->angkatan_rooms,
            'jurusan_id' => $this->jurusan_id,
        ]);

        session()->flash('success', 'Room berhasil diupdate.');
        return redirect()->to(route('teacher.rooms.index'));
    }
}