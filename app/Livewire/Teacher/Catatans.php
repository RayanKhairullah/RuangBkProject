<?php

namespace App\Livewire\Teacher;

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
    public int $perPage = 10;
    public string $search = '';
    public string $siswa_search = '';
    public array $siswaResults = [];
    public $siswa_id = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'siswa_search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function updatingSearchSiswa(): void
    {
        $this->resetPage();
    }

    public function updatedSiswaSearch(string $value)
    {
        $this->siswaResults = \App\Models\User::role('student')
            ->where('name', 'like', "%{$value}%")
            ->orderBy('name')
            ->limit(10)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function searchSiswa($query)
    {
        $this->siswa_search = $query;
        if (strlen($query) > 0) {
            $this->siswaResults = \App\Models\User::role('student')
                ->where('name', 'like', "%{$query}%")
                ->orderBy('name')
                ->limit(10)
                ->pluck('name', 'id')
                ->toArray();
        } else {
            $this->siswaResults = [];
        }
    }

    public function selectSiswa($id)
    {
        $this->siswa_id = $id;
        $this->siswa_search = $this->siswaResults[$id] ?? '';
        $this->siswaResults = [];
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $this->authorize('view catatan teacher');

        $catatans = Catatan::query()
            ->with(['siswa', 'guru', 'room'])
            ->when($this->siswa_id, function ($query) {
                $query->where('user_id', $this->siswa_id);
            })
            ->when($this->search, function ($query) {
                $query->whereHas('guru', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )
                ->orWhere('masalah_dibahas', 'like', "%{$this->search}%");
            })
            ->orderByDesc('tanggal')
            ->paginate($this->perPage);

        return view('livewire.teacher.catatans', [
            'catatans' => $catatans,
        ]);
    }

    public function deleteCatatan($id)
    {
        $this->authorize('delete catatan');
        $catatan = Catatan::findOrFail($id);
        $catatan->delete();
        $this->alert('success', 'Catatan berhasil dihapus.');
    }
}