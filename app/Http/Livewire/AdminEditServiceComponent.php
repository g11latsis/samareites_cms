<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\IndUser;

class AdminEditServiceComponent extends Component
{
    public $service;
    
    public function render()
    {
        $parts = explode(",", $this->service->parts);
        $users = IndUser::all();
        return view('livewire.admin-edit-service-component', ['users' => $users, 'parts' => $parts]);
    }
}
