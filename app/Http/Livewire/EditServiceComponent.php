<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\IndUser;

class EditServiceComponent extends Component
{
    public $service;

    public function render()
    {
        $parts = explode(",", $this->service->parts);
        $users = IndUser::where('region', session('ra')->region)->get();
        return view('livewire.edit-service-component', ['users' => $users, 'parts' => $parts]);
    }
}
