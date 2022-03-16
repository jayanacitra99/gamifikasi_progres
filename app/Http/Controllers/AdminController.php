<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        if($this->middleware('auth')){
            $this->middleware('admin');
        }
    }

    public function index(){
        return view('admin/dashboard');
    }

    public function register(){
        return view('admin/register');
    }

    public function registerNewUser(){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');

        Request()->validate([
            'name' => 'required|string|max:255',
            'role' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = [
            'name' => Request()->name,
            'role' => Request()->role,
            'email' => Request()->email,
            'password' => bcrypt(Request()->password),
            'badges' => 'Bronze',
            'levels' => 0,
            'point' => 0,
            'created_at' => $timestamp,
            'updated_at' => $timestamp

        ];

        $this->AdminModel->addNewUser($data);
        return redirect()->route('register');
    }
}
