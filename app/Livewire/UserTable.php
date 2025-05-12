<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;;

class UserTable extends Component
{
    use WithPagination;

    public $searchName = '';
    public $searchRole = '';
    public $perPage = 10;

    protected function updatingSearchName()
    {
        $this->resetPage();
    }

    protected function updatingSearchRole()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query()
            ->when($this->searchName, function ($q) {
                $q->where('name', 'like', '%'.$this->searchName.'%');
            })
            ->when($this->searchRole, function ($q) {
                $q->where('role', $this->searchRole);
            });

        return view('livewire.user-table', [
            'users' => $query->paginate($this->perPage),
        ]);
    }
}
