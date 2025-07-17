<?php

namespace App\Livewire\Student\JadwalKonselings;

use App\Models\JadwalKonseling;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewJadwalKonseling extends Component
{
    public JadwalKonseling $jadwal;

    public function mount(JadwalKonseling $jadwal)
    {
        $this->authorize('view konselings');
        $this->jadwal = $jadwal->load('pengirim', 'penerima');
    }

    #[Layout('components.layouts.student')]
    public function render(): View
    {
        return view('livewire.student.jadwal-konselings.jadwal-konselings-view', [
            'jadwal' => $this->jadwal,
        ]);
    }
}
