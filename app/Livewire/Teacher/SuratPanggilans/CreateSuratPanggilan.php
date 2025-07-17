<?php

namespace App\Livewire\Teacher\SuratPanggilans;

use App\Models\Biodata;
use App\Models\Room;
use App\Models\SuratPanggilan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateSuratPanggilan extends Component
{
    use LivewireAlert;

    public string $nomor_surat = '';
    public string $tanggal_waktu = '';
    public string $tempat = '';
    public string $tujuan = '';
    public $biodata_id;
    public $room_id;
    public $searchSiswa = '';
    public $searchRoom = '';

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $this->authorize('create surat panggilan');
        return view('livewire.teacher.suratpanggilans.surat-panggilans-create', [
            'filteredBiodatas' => $this->filteredBiodatas,
            'filteredRooms' => $this->filteredRooms,
            'searchSiswa' => $this->searchSiswa,
            'searchRoom' => $this->searchRoom,
        ]);
    }

    public function save()
    {
        $this->authorize('create surat panggilan');
        $this->validate([
            'nomor_surat' => 'required|string|unique:surat_panggilans,nomor_surat',
            'tanggal_waktu' => 'required|date',
            'tempat' => 'required|string|max:255',
            'tujuan' => 'required|string|max:500',
            'biodata_id' => 'required|exists:biodatas,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        SuratPanggilan::create([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_waktu' => $this->tanggal_waktu,
            'tempat' => $this->tempat,
            'tujuan' => $this->tujuan,
            'biodata_id' => $this->biodata_id,
            'room_id' => $this->room_id,
        ]);

        $this->alert('success', 'Surat panggilan berhasil dibuat.');
        return redirect()->route('teacher.surat-panggilans.index');
    }

    public function getFilteredBiodatasProperty()
    {
        if (empty($this->searchSiswa)) {
            return collect();
        }

        return Biodata::with('user')
            ->whereHas('user', fn($q) =>
                $q->where('name', 'like', '%' . $this->searchSiswa . '%')
            )
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    }

    public function getFilteredRoomsProperty()
    {
        if (empty($this->searchRoom)) {
            return collect();
        }

        return Room::where('kode_rooms', 'like', '%' . $this->searchRoom . '%')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    }
}
