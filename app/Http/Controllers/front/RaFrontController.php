<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndUser;
use App\Models\Service;
use App\Models\rAdmins;

class RaFrontController extends Controller
{
    public function index()
    {
        $users = IndUser::where('region', session('ra')->region)->count();
        $services = Service::where('region', session('ra')->region)->count();
        $parts = IndUser::where('region', session('ra')->region)->where('part_status', true)->count();
        return view('ra.dashboard', compact('users', 'services', 'parts'));
    }

    public function user(Request $request)
    {
        if($request->search != ""){
            $search = $request->search;
            $users = IndUser::where('region', session('ra')->region)->where('name', 'LIKE', "%$search%")->count();
            if($users > 0){
                $users = IndUser::where('region', session('ra')->region)->where('name', 'LIKE', "%$search%")->paginate(11);
            }else{
                $users = IndUser::where('region', session('ra')->region)->where('email', 'LIKE', "%$search%")->paginate(11);
            }
        }else{
            $users = IndUser::where('region', session('ra')->region)->paginate(11);
            $search = "";
        }
        return view('ra.user', compact('users', 'search'));
    }

    public function user_profile($id)
    {
        $user = IndUser::find($id);
        return view('ra.userProfile', compact('user'));
    }

    public function service(Request $request)
    {
        if($request->search != ""){
            $search = $request->search;
            $services = Service::where('ra_id', session('ra')->id)->where('name', 'LIKE', "%$search%")->paginate(7);
        }else{
            $services = Service::where('ra_id', session('ra')->id)->paginate(7);
            $search = "";
        }
        return view('ra.service', compact('services', 'search'));
    }

    public function ra_service_profile($id)
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
        return view('ra.serviceProfile', compact('service', 'parts'));
    }

    public function ra_profile($id)
    {
        $ra = rAdmins::find($id);
        return view('ra.raProfile', compact('ra'));
    }
}
