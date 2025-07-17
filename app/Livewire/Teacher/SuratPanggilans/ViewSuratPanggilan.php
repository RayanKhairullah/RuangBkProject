<?php

namespace App\Livewire\Teacher\SuratPanggilans;

use App\Models\SuratPanggilan;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ViewSuratPanggilan extends Component
{
    public SuratPanggilan $surat;

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $this->authorize('view surat panggilan');

        $this->surat->load(['biodata.user', 'room']);

        return view('livewire.teacher.suratpanggilans.surat-panggilans-view', [
            'surat' => $this->surat
        ]);
    }
}
