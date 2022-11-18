<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        if($admin){
            if(Hash::check($request->password, $admin->password)){
                session()->put(['admin_loggedin' => true, 'admin_id' => $admin->id, 'admin_pass' => $request->password]);
                return redirect('/admin/dashboard');
            }else{
                session()->flash('ad_log_email', $request->email);
                return redirect()->back()->with(session()->flash('error', 'Invalid credentials'));
            }
       }else{
            return redirect()->back()->with(session()->flash('error', 'Invalid credentials'));
       }
    }
}
