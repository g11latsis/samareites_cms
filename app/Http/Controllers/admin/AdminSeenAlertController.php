<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Todo;

class AdminSeenAlertController extends Controller
{
    public function index()
    {
        
        $alerts = Alert::all();

        foreach($alerts as $alert){
            $alert->update([
                'seenbyadmin' => true,
            ]);
        }

        return response()->json(array('msg'=> 'seen'), 200);
    }
}