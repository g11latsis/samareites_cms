<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function ra()
    {
        session()->forget('ra');
        session()->forget('ralogged');
        return redirect('/');
    }
}