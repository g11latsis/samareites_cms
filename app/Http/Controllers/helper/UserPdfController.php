<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndUser;

class UserPdfController extends Controller
{
    public function update(Request $request, $id)
    {
        if($request->hasFile("cv")){
            $request->validate([
                'cv' => 'required',
            ]);

            if($request->cv != ""){
                $cv = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->cv->extension();
                $request->cv->move(public_path('images'), $cv);
            }else{
                $cv = "";
            }
            
            $user = IndUser::find($id);
            $user->update([
                'cv' => $cv,
            ]);

            return redirect()->back()->with(session()->flash('alert', 'ΕΠΙΚΑΙΡΟΠΟΙΗΜΕΝΟ'));
        }
    }

    public function delete($name, $id)
    {
        $user = IndUser::find($id);
        if($user){
            $user->update([
                $name => "",
            ]);

            return redirect()->back()->with(session()->flash('alert', 'ΕΠΙΚΑΙΡΟΠΟΙΗΜΕΝΟ
            '));
        }
    }
}
