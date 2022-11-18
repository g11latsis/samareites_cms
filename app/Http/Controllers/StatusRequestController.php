<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\rAdmins;
use App\Models\IndUser;
use App\Models\Alert;

class StatusRequestController extends Controller
{
    public function ra_status_request(Request $request)
    {
        $ra = rAdmins::find($request->id);
        if($ra){
            $alert = Alert::create([
                'fromid' => $ra->id,
                'from' => $ra->name,
                'to1' => 'admin',
                'to2' => $ra->id,
                'to3' => '',
                'desc1' => $ra->fname.$ra->lname.'_Περιφερειακός Διαχειριστής κάνει αίτημα για ενεργοποίηση λογαριασμού.',
                'desc2' => '',
                'desc3' => '',
            ]);

            if($alert){
                return redirect()->back()->with(session()->flash('alert', 'Το αίτημά σας στάλθηκε στον Κεντρικό Διαχειριστή.'));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function user_status_request(Request $request)
    {
        $user = DB::table('ind_users')->find($request->id);
        if($user){
            $ra = DB::table('r_admins')->where('region', $user->region)->first();

            $alert = Alert::create([
                'fromid' => $user->id,
                'from' => $user->name,
                'to1' => 'admin',
                'to2' => $ra->id,
                'to3' => '',
                'desc1' => $user->name.'_εθελοντής κάνει αίτημα για ενεργοποίηση λογαριασμού.',
                'desc2' => $user->name.'_εθελοντής κάνει αίτημα για ενεργοποίηση λογαριασμού.',
                'desc3' => '',
            ]);

            if($alert){
                return redirect()->back()->with(session()->flash('alert', 'Το αίτημά σας στάλθηκε στον Κεντρικό και Περιφερειακό Διαχειριστή.'));
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
