<?php

namespace App\Livewire\Student\JadwalKonselings;

use App\Models\JadwalKonseling;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Notifications\JadwalKonselingDibuat;

class CreateJadwalKonseling extends Component
{
    use LivewireAlert;

    public string $lokasi = '';
    public string $tanggal = '';
    public string $topik_dibahas = '';
    public string $solusi = '';
    public string $status = 'pending';
    public string $alasan_penolakan = '';
    public $penerima_id;

    #[Layout('components.layouts.student')]
    public function render(): View
    {
        $this->authorize('create konselings');
        $gurus = User::role('teacher')->get(); // opsional: kalau mau pilih guru
        return view('livewire.student.jadwal-konselings.jadwal-konselings-create', compact('gurus'));
    }

    public function save()
    {
        $this->authorize('create konselings');

        $this->validate([
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'topik_dibahas' => 'required|string|max:1000',
            'status' => 'required|in:pending,accepted,rejected',
            'alasan_penolakan' => 'nullable|string|max:1000',
            'penerima_id' => 'nullable|exists:users,id',
        ]);

        JadwalKonseling::create([
            'pengirim_id' => Auth::id(),
            'penerima_id' => $this->penerima_id,
            'lokasi' => $this->lokasi,
            'tanggal' => $this->tanggal,
            'topik_dibahas' => $this->topik_dibahas,
            'solusi' => $this->solusi,
            'status' => $this->status,
            'alasan_penolakan' => $this->status === 'rejected' ? $this->alasan_penolakan : null,
        ]);
        
        $this->alert('success', 'Jadwal Konseling berhasil dibuat.');
        return redirect()->route('student.jadwal-konselings.index');
    }
}