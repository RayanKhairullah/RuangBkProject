<?php

namespace App\Livewire\Teacher;

use App\Models\Jurusan;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Jurusans extends Component
{
    use WithPagination, LivewireAlert;

    #[Session]
    public int $perPage = 10;

    #[Url]
    public string $search = '';

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $this->authorize('view jurusan');

        $jurusans = Jurusan::query()
            ->when($this->search, fn($q) =>
                $q->where('nama_jurusan', 'like', "%{$this->search}%")
            )
            ->paginate($this->perPage);

        return view('livewire.teacher.jurusans', compact('jurusans'));
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function deleteJurusan(string $id): void
    {
        $this->authorize('delete jurusan');

        Jurusan::findOrFail($id)->delete();
        $this->alert('success', 'Jurusan berhasil dihapus.');
        $this->resetPage();
    }
}
