<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

class UserController extends Controller
{
    public function logout(){

        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
