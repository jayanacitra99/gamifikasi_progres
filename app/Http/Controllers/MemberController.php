<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function __construct()
    {
        if($this->middleware('auth')){
            $this->middleware('member');
        }
    }

    public function index(){
        return view('dashboard');
    }
}
