<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\IndUser;
use App\Models\rAdmins;

class FrontController extends Controller
{
    public function home()
    {
        $all_services = Service::paginate(6);
        if(session('userlogged') == true){
            $user = IndUser::find(session('user')->id);
        }else{
            $user = "";
        }
        return view('index', compact('all_services', 'user'));
    }

    public function search(Request $request)
    {
        if($request->search != ""){
            if($request->choice == 1){
                $type = 1;
                $results = IndUser::where("name", "LIKE", "%$request->search%")->get();
            }else{
                $type = 2;
                $results = rAdmins::where("fname", "LIKE", "%$request->search%")->orWhere("lname", "LIKE", "%$request->search%")->get();
            }

            $search = $request->search;

            return view('search', compact('results', 'type', 'search'));
        }else{
            return redirect()->back();
        }
    }
}