<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;

class UserAlertController extends Controller
{
    public function delete()
    {
        $alerts = Alert::all();
        
        foreach($alerts as $alert){
            $alert->update([
                'trashedbyuser' => true,
            ]);
        }

        return redirect('/');
    }
}