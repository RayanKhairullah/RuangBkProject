<?php

namespace App\Livewire\Teacher;

use App\Models\SuratPanggilan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Session;

class SuratPanggilans extends Component
{
    use WithPagination, LivewireAlert;

    #[Session]
    public int $perPage = 10;

    public string $search = '';

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
        $this->authorize('view surat panggilan');

        $suratPanggilans = SuratPanggilan::query()
            ->with(['biodata.user', 'room'])
            ->when($this->search, function ($query) {
                $query->where('nomor_surat', 'like', "%{$this->search}%")
                    ->orWhereHas('biodata.user', fn($q) =>
                        $q->where('name', 'like', "%{$this->search}%")
                    );
            })
            ->orderByDesc('tanggal_waktu')
            ->paginate($this->perPage);

        return view('livewire.teacher.surat-panggilans', compact('suratPanggilans'));
    }

    public function deleteSurat($id)
    {
        $this->authorize('delete surat panggilan');
        $surat = SuratPanggilan::findOrFail($id);
        $surat->delete();
        $this->alert('success', 'Surat panggilan berhasil dihapus.');
    }
}