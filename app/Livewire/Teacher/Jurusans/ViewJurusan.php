<?php

namespace App\Livewire\Teacher\Jurusans;

use App\Models\Jurusan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewJurusan extends Component
{
    public Jurusan $jurusan;

    public function mount(Jurusan $jurusan)
    {
        $this->authorize('view jurusan');
        $this->jurusan = $jurusan;
    }

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        return view('livewire.teacher..jurusans.jurusans-view', [
            'jurusan' => $this->jurusan,
        ]);
    }
}