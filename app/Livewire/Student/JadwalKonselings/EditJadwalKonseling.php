<?php

namespace App\Livewire\Student\JadwalKonselings;

use App\Models\JadwalKonseling;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditJadwalKonseling extends Component
{
    public JadwalKonseling $jadwal;
    public string $lokasi;
    public string $tanggal;
    public string $topik_dibahas;
    public string $solusi;
    public string $status;
    public string $alasan_penolakan;

    public function mount(JadwalKonseling $jadwal)
    {
        $this->authorize('update konselings');

        $this->jadwal = $jadwal;
        $this->lokasi = $jadwal->lokasi;
        $this->tanggal = $jadwal->tanggal;
        $this->topik_dibahas = $jadwal->topik_dibahas;
        $this->solusi = $jadwal->solusi ?? '';
        $this->status = $jadwal->status ?? 'pending';
        $this->alasan_penolakan = $jadwal->alasan_penolakan ?? '';
    }

    #[Layout('components.layouts.student')]
    public function render(): View
    {
        return view('livewire.student.jadwal-konselings.jadwal-konselings-edit');
    }

    public function update()
    {
        $this->authorize('update konselings');

        $validated = $this->validate([
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'topik_dibahas' => 'required|string',
            'status' => 'required|in:pending,accepted,rejected',
            'solusi' => 'nullable|string',
            'alasan_penolakan' => 'nullable|string'
        ]);

        if ($this->status === 'rejected' && !$this->alasan_penolakan) {
            $this->addError('alasan_penolakan', 'Alasan penolakan wajib diisi jika status ditolak.');
            return;
        }

        $this->jadwal->update($validated);

        session()->flash('success', 'Jadwal konseling berhasil diperbarui.');
        return redirect()->route('student.jadwal-konselings.index');
    }
}
