<?php

namespace App\Livewire\Student;

use App\Models\Catatan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Session;

class Catatans extends Component
{
    use WithPagination, LivewireAlert;

    #[Session]
    public int $perPage = 5;

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
        $this->authorize('view catatan student');

        $catatans = Catatan::query()
            ->with(['siswa', 'guru', 'room'])
            ->when($this->search, function ($query) {
                $query->whereHas('siswa', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )
                ->orWhereHas('guru', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )
                ->orWhere('masalah_dibahas', 'like', "%{$this->search}%");
            })
            ->orderByDesc('tanggal')
            ->paginate($this->perPage);

        return view('livewire.student.catatans', compact('catatans'));
    }
}