<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstrukturController extends Controller
{
    //
    public function __construct()
    {
        if($this->middleware('auth')){
            $this->middleware('instruktur');
        }
    }

    public function index(){
        return view('instruktur/dashboard');
    }
}
