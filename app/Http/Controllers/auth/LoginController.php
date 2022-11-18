<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\IndUser;
use App\Models\rAdmins;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('front.auth.login');
    }

    public function login(Request $request)
    {
        if(session()->has('admin_loggedin') ||  session()->has('ralogged') || session()->has('userlogged')){
            return redirect()->back();
        }else{
            $request->validate([
                'email' => 'required | email',
                'password' => 'required',
            ]);
    
            if($request->iden == "user"){
                $user = IndUser::where('email', $request->email)->first();
                if($user){
                    if(Hash::check($request->password, $user->password)){
                        if($user->status == true){
                            session()->put('user', $user);
                            session()->put('userlogged', true);
                            return redirect('/user/dash');
                        }else{
                            session()->flash('user_status_id', $user->id);
                            return redirect()->back()->with(session()->flash('user_status_error', 'Ο λογαριασμός σας είναι προς το παρόν απενεργοποιημένος.'));
                        }
                    }else{
                        return redirect()->back()->with(session()->flash('error', 'Invalid Credentials for user'));
                    }
                }else{
                    return redirect()->back()->with(session()->flash('error', 'Invalid Credentials for'));
                }
            }else{
                $ra = rAdmins::where('email', $request->email)->first();
                if($ra){
                    if(Hash::check($request->password, $ra->password)){
                        if($ra->status2 == true){
                            session()->put('ra', $ra);
                            session()->put('ralogged', true);
                            return redirect('/ra/dash');
                        }else{
                            session()->flash('ra_status_id', $ra->id);
                            return redirect()->back()->with(session()->flash('ra_status_error', 'Ο λογαριασμός σας είναι προς το παρόν απενεργοποιημένος.'));
                        }
                    }else{
                        return redirect()->back()->with(session()->flash('error', 'Invalid Credentials'));
                    }
                }else{
                    return redirect()->back()->with(session()->flash('error', 'Invalid Credentials'));
                }
            }  
        }
    }
}