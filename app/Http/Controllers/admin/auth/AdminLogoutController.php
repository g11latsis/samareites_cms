<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLogoutController extends Controller
{
    public function index()
    {
        session()->forget('admin_loggedin', 'admin_id', 'admin_pass');
        return redirect('/');
    }
}
