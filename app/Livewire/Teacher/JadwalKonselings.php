<?php

namespace App\Livewire\Teacher;

use App\Models\JadwalKonseling;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Session;
use Illuminate\Support\Facades\Auth;

class JadwalKonselings extends Component
{
    use WithPagination, LivewireAlert;

    #[Session]
    public int $perPage = 10;

    public string $search = '';
    public string $solusi = '';
    public string $alasan_penolakan = '';

    public int $selectedId = 0;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $this->authorize('view konselings student');

        $jadwalKonselings = JadwalKonseling::query()
            ->with(['pengirim', 'penerima'])
            ->where('penerima_id', Auth::id())
            ->when($this->search, function ($query) {
                $query->whereHas('pengirim', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )->orWhereHas('penerima', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )->orWhere('topik_dibahas', 'like', "%{$this->search}%");
            })
            ->orderByDesc('tanggal')
            ->paginate($this->perPage);

        return view('livewire.teacher.jadwal-konselings', compact('jadwalKonselings'));
    }

    public function confirmTerima(int $id)
    {
        $this->selectedId = $id;
        $this->dispatch('open-modal', 'terima-konseling');
    }

    public function confirmTolak(int $id)
    {
        $this->selectedId = $id;
        $this->dispatch('open-modal', 'tolak-konseling');
    }

    public function setujui()
    {
        $this->authorize('update konselings');
        $jadwal = JadwalKonseling::findOrFail($this->selectedId);
        $jadwal->update([
            'status' => JadwalKonseling::STATUS_ACCEPTED
        ]);

        $this->alert('success', 'Jadwal konseling disetujui.');
        $this->reset(['selectedId']);
    }

    public function tolak()
    {
        $this->authorize('update konselings');

        $jadwal = JadwalKonseling::findOrFail($this->selectedId);
        $jadwal->update([
            'status' => JadwalKonseling::STATUS_REJECTED,
            'alasan_penolakan' => $this->alasan_penolakan
        ]);

        $this->alert('warning', 'Jadwal konseling ditolak.');
        $this->reset(['selectedId', 'alasan_penolakan']);
    }

    public function simpanSolusi(int $id)
    {
        $this->authorize('update konselings');

        $jadwal = JadwalKonseling::findOrFail($id);
        $jadwal->update([
            'solusi' => $this->solusi
        ]);

        $this->alert('success', 'Solusi berhasil disimpan.');
        $this->reset(['solusi']);
    }

    public function deleteJadwal($id)
    {
        $this->authorize('delete konselings');
        JadwalKonseling::findOrFail($id)->delete();
        $this->alert('success', 'Jadwal berhasil dihapus.');
    }
}
