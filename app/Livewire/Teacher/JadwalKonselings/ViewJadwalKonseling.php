<?php

namespace App\Livewire\Teacher\JadwalKonselings;

use App\Models\JadwalKonseling;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewJadwalKonseling extends Component
{
    public JadwalKonseling $jadwal;

    public function mount(JadwalKonseling $jadwal)
    {
        $this->authorize('view konselings student');
        $this->jadwal = $jadwal->load('pengirim', 'penerima');
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        return view('livewire.teacher.jadwal-konselings.jadwal-konselings-view', [
            'jadwal' => $this->jadwal,
        ]);
    }
}
