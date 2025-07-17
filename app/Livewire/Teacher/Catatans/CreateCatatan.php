<?php

namespace App\Livewire\Teacher\Catatans;

use App\Models\Catatan;
use App\Models\Room;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateCatatan extends Component
{
    public string $masalah_dibahas = '';
    public string $tindak_lanjut = '';
    public string $hasil_akhir = '';
    public string $poin = '';
    public string $tanggal = '';
    public $user_id = '';
    public $room_id = '';
    public $searchSiswa = '';
    public string $searchKelas = '';
    public $filteredRooms;

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $this->authorize('create catatan');
        $filteredSiswas = !empty($this->searchSiswa)
        ? User::role('student')
            ->where('name', 'like', '%' . $this->searchSiswa . '%')
            ->orderBy('name')
            ->limit(10)
            ->get()
        : collect();

        $this->filteredRooms = !empty($this->searchKelas)
            ? Room::where('kode_rooms', 'like', '%' . $this->searchKelas . '%')
                ->orderBy('kode_rooms')
                ->limit(10)
                ->get()
            : collect();

        return view('livewire.teacher.catatans.catatans-create', [
            'filteredSiswas' => $filteredSiswas,
            'filteredRooms' => $this->filteredRooms,
            'searchSiswa' => $this->searchSiswa,
            'user_id' => $this->user_id,
        ]);
    }

    public function save()
    {
        $this->authorize('create catatan');
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'tanggal' => 'required|date',
            'masalah_dibahas' => 'required|string',
            'tindak_lanjut' => 'nullable|string',
            'hasil_akhir' => 'nullable|string',
            'poin' => 'required|numeric',
        ]);

        Catatan::create([
            'user_id' => $this->user_id,
            'room_id' => $this->room_id,
            'guru_id' => auth()->id(),
            'tanggal' => $this->tanggal,
            'masalah_dibahas' => $this->masalah_dibahas,
            'tindak_lanjut' => $this->tindak_lanjut,
            'hasil_akhir' => $this->hasil_akhir,
            'poin' => $this->poin,
        ]);

        session()->flash('success', 'Catatan berhasil dibuat.');
        return redirect()->route('teacher.catatans.index');
    }
}
