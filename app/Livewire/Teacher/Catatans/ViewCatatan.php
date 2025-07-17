<?php

namespace App\Livewire\Teacher\Catatans;

use App\Models\Catatan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewCatatan extends Component
{
    public Catatan $catatan;

    public function mount(Catatan $catatan)
    {
        $this->authorize('view catatan teacher');
        $this->catatan = $catatan->load(['siswa', 'guru', 'room']);
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        return view('livewire.teacher.catatans.catatans-view', [
            'catatan' => $this->catatan,
        ]);
    }
}
