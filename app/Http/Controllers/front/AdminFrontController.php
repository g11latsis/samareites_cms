<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rAdmins;
use App\Models\IndUser;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Alert;
use Illuminate\Support\Facades\Hash;

class AdminFrontController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        $ras = rAdmins::all()->count();
        $users = IndUser::all()->count();
        $services = Service::all()->count();
        $parts = IndUser::where('part_status', true)->count();
        return view('admin.dashboard', compact('ras', 'users', 'services', 'parts'));
    }

    public function regional_admin(Request $request)
    {
        if($request->search != ""){
            $search = $request->search;
            $rgs = rAdmins::where('fname', 'LIKE', "%$search%")->orWhere('lname', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->paginate(11);
        }else{
            $rgs = rAdmins::paginate(11);
            $search = "";
        }
        return view('admin.ra', compact('rgs', 'search'));
    }

    public function user_admin(Request $request)
    {
        if($request->search != ""){
            $search = $request->search;
            $users = IndUser::where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%")->paginate(11);
        }else{
            $users = IndUser::paginate(11);
            $search = "";
        }
        return view('admin.user', compact('users', 'search'));
    }

    public function ra_profile($id)
    {
        $ra = rAdmins::find($id);
        return view('admin.raProfile', compact('ra'));
    }

    public function user_profile($id)
    {
        $user = IndUser::find($id);
        return view('admin.userProfile', compact('user'));
    }

    public function admin_profile()
    {
        $admin = Admin::find(session('admin_id'));
        return view('admin.adminProfile', compact('admin'));
    }

    public function admin_profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required',
        ]);
        $admin = Admin::find(session('admin_id'));
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        session()->put(['admin_loggedin' => true, 'admin_id' => $admin->id, 'admin_pass' => $request->password]);
        return redirect()->back()->with(session()->flash('alert', 'Το προφιλ ενημερωθηκε!'));
    }

    public function service(Request $request)
    {
        if($request->search != ""){
            $search = $request->search;
            $services = Service::where('name', 'LIKE', "%$search%")->paginate(7);
        }else{
            $services = Service::paginate(7);
            $search = "";
        }
        return view('admin.service', compact('services', 'search'));
    }
    
    public function admin_service_profile($id)
    {
        $service = Service::find($id);
        $arr = explode(',', $service->parts);
        $parts = [];
        foreach($arr as $ar){
            $part = IndUser::find($ar);
            if($part){
                array_push($parts, $part);
            }
        }
        return view('admin.serviceProfile', compact('service', 'parts'));
    }
}