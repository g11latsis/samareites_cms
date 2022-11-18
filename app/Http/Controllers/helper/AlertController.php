<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;

class AlertController extends Controller
{
    public function admin_delete_alert()
    {
        $alerts = Alert::where('to1', "admin")->get();
        foreach($alerts as $alert){
            $alert->update([
                'trashedbyadmin' => true,
            ]);
        }
        if($alert){
            return redirect()->back();
        }
    }
}
