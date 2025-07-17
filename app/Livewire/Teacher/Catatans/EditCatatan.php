<?php

namespace App\Livewire\Teacher\Catatans;

use App\Models\Catatan;
use App\Models\Room;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditCatatan extends Component
{
    public Catatan $catatan;

    public string $masalah_dibahas;
    public string $tindak_lanjut;
    public string $hasil_akhir;
    public string $poin;
    public string $tanggal;
    public $user_id;
    public $room_id;
    public $searchSiswa = '';
    public $searchKelas = '';
    public $filteredRooms;

    public function mount(Catatan $catatan)
    {
        $this->authorize('update catatan');
        $this->catatan = $catatan;
        $this->user_id = $catatan->user_id;
        $this->room_id = $catatan->room_id;
        $this->tanggal = $catatan->tanggal;
        $this->masalah_dibahas = $catatan->masalah_dibahas;
        $this->tindak_lanjut = $catatan->tindak_lanjut;
        $this->hasil_akhir = $catatan->hasil_akhir;
        $this->poin = $catatan->poin;
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
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

        return view('livewire.teacher.catatans.catatans-edit', [
            'filteredSiswas' => $filteredSiswas,
            'filteredRooms' => $this->filteredRooms,
            'searchSiswa' => $this->searchSiswa,
            'user_id' => $this->user_id,
        ]);
    }

    public function update()
    {
        $this->authorize('update catatan');
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'tanggal' => 'required|date',
            'masalah_dibahas' => 'required|string',
            'tindak_lanjut' => 'nullable|string',
            'hasil_akhir' => 'nullable|string',
            'poin' => 'required|numeric',
        ]);

        $this->catatan->update([
            'user_id' => $this->user_id,
            'room_id' => $this->room_id,
            'tanggal' => $this->tanggal,
            'masalah_dibahas' => $this->masalah_dibahas,
            'tindak_lanjut' => $this->tindak_lanjut,
            'hasil_akhir' => $this->hasil_akhir,
            'poin' => $this->poin,
        ]);

        session()->flash('success', 'Catatan berhasil diperbarui.');
        return redirect()->route('teacher.catatans.index');
    }
}
