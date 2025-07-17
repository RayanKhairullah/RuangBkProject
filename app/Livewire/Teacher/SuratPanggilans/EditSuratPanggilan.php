<?php

namespace App\Livewire\Teacher\SuratPanggilans;

use App\Models\Room;
use App\Models\Biodata;
use App\Models\SuratPanggilan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;

class EditSuratPanggilan extends Component
{
    public SuratPanggilan $surat;
    public $nomor_surat;
    public $biodata_id;
    public $room_id;
    public $tanggal_waktu;
    public $tempat;
    public $tujuan;
    public $searchSiswa = '';
    public $searchRoom = '';

    #[Layout('components.layouts.teacher')]
    public function mount(SuratPanggilan $surat): void
    {
        Gate::authorize('update surat panggilan');

        $this->surat = $surat;
        $this->nomor_surat = $surat->nomor_surat;
        $this->biodata_id = $surat->biodata_id;
        $this->room_id = $surat->room_id;
        $this->tanggal_waktu = $surat->tanggal_waktu;
        $this->tempat = $surat->tempat;
        $this->tujuan = $surat->tujuan;
    }

    public function update()
    {
        Gate::authorize('update surat panggilan');

        $this->validate([
            'nomor_surat' => 'required',
            'biodata_id' => 'required|exists:biodatas,id',
            'room_id' => 'required|exists:rooms,id',
            'tanggal_waktu' => 'required|date',
            'tempat' => 'required|string',
            'tujuan' => 'required|string',
        ]);

        $this->surat->update([
            'nomor_surat' => $this->nomor_surat,
            'biodata_id' => $this->biodata_id,
            'room_id' => $this->room_id,
            'tanggal_waktu' => $this->tanggal_waktu,
            'tempat' => $this->tempat,
            'tujuan' => $this->tujuan,
        ]);

        session()->flash('success', 'Surat berhasil diperbarui.');
        return redirect()->route('teacher.surat-panggilans.index');
    }

    public function getFilteredBiodatasProperty()
    {
        $query = Biodata::with('user');

        if (!empty($this->searchSiswa)) {
            $query->whereHas('user', fn($q) =>
                $q->where('name', 'like', '%' . $this->searchSiswa . '%')
            );
        } elseif ($this->biodata_id) {
            // Include the currently selected biodata even if there's no search
            $query->where('id', $this->biodata_id);
        } else {
            return collect();
        }

        return $query->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    }

    public function getFilteredRoomsProperty()
    {
        $query = Room::query();

        if (!empty($this->searchRoom)) {
            $query->where('kode_rooms', 'like', '%' . $this->searchRoom . '%');
        } elseif ($this->room_id) {
            // Include the currently selected room even if there's no search
            $query->where('id', $this->room_id);
        } else {
            return collect();
        }

        return $query->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    }

    public function render(): View
    {
        return view('livewire.teacher.suratpanggilans.surat-panggilans-edit', [
            'filteredBiodatas' => $this->filteredBiodatas,
            'filteredRooms' => $this->filteredRooms,
            'searchSiswa' => $this->searchSiswa,
            'searchRoom' => $this->searchRoom,
        ]);
    }
}
