<?php

namespace App\Livewire\Student;

use App\Models\JadwalKonseling;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\JadwalKonselingMail;

class JadwalKonselings extends Component
{
    use WithPagination, LivewireAlert;

    #[Session]
    public int $perPage = 5;

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
        $this->authorize('view konselings');

        $jadwalKonselings = JadwalKonseling::query()
            ->with(['pengirim', 'penerima'])
            ->where('pengirim_id', Auth::id())
            ->when($this->search, function ($query) {
                $query->whereHas('pengirim', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )->orWhereHas('penerima', fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )->orWhere('topik_dibahas', 'like', "%{$this->search}%");
            })
            ->orderByDesc('tanggal')
            ->paginate($this->perPage);

        return view('livewire.student.jadwal-konselings', compact('jadwalKonselings'));
    }

    public function sendEmailToTeacher($id)
    {
        $jadwal = JadwalKonseling::with('penerima')->findOrFail($id);

        // Otorisasi: hanya pengirim yang boleh kirim email
        if ($jadwal->pengirim_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // Kirim email ke guru (penerima)
        try {
            Mail::to($jadwal->penerima->email)->send(new JadwalKonselingMail($jadwal));
            $this->alert('success', 'Email berhasil dikirim ke guru.');
        } catch (\Exception $e) {
            $this->alert('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }
}
