<?php

namespace App\Livewire\Student\Catatans;

use App\Models\Catatan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewCatatan extends Component
{
    public Catatan $catatan;

    public function mount(Catatan $catatan)
    {
        $this->authorize('view catatan student');
        $this->catatan = $catatan->load(['siswa', 'guru', 'room']);
    }

    #[Layout('components.layouts.student')]
    public function render(): View
    {
        return view('livewire.student.catatans.catatans-view', [
            'catatan' => $this->catatan,
        ]);
    }
}
