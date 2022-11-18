<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\IndUser;

class AdminServiceComponent extends Component
{
    public function render()
    {
        $users = IndUser::all();
        return view('livewire.admin-service-component', ['users' => $users]);
    }
}