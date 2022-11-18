<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\IndUser;

class ServiceComponent extends Component
{
    public function render()
    {
        $users = IndUser::where('region', session('ra')->region)->get();
        return view('livewire.service-component', ['users' => $users]);
    }
}
