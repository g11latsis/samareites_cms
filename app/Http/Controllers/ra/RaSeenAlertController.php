<?php

namespace App\Http\Controllers\ra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;

class RaSeenAlertController extends Controller
{
    public function index()
    {
        
        $alerts = Alert::all();

        foreach($alerts as $alert){
            $alert->update([
                'seenbyra' => true,
            ]);
        }

        return response()->json(array('msg'=> 'seen'), 200);
    }

    public function delete()
    {
        $alerts = Alert::all();
        
        if($alerts){
            foreach($alerts as $alert){
                $alert->update([
                    'trashedbyra' => true,
                ]);
            }
        }

        return redirect()->back();
    }
}
