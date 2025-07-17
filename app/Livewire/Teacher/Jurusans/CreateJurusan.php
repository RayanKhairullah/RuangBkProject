<?php

namespace App\Livewire\Teacher\Jurusans;

use App\Models\Jurusan;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateJurusan extends Component
{
    public string $nama_jurusan = '';

    #[Layout('components.layouts.teacher')]
    public function render(): View
    {
        $this->authorize('create jurusan');
        return view('livewire.teacher.jurusans.jurusans-create');
    }

    public function save()
    {
        $this->authorize('create jurusan');
        $this->validate([
            'nama_jurusan' => 'required|unique:jurusans,nama_jurusan',
        ]);

        Jurusan::create([
            'nama_jurusan' => $this->nama_jurusan,
        ]);

        session()->flash('success', 'Jurusan berhasil dibuat.');
        return redirect()->route('teacher.jurusans.index');
    }
}