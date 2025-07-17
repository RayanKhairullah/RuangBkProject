<?php

namespace App\Livewire\Student;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('components.layouts.student')]
    public function render(): View
    {
        return view('livewire.student.index');
    }
}
