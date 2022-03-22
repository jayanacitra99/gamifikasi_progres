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
        Request()->session()->flash('success','Register New User Success!!');
        return redirect()->route('register');
    }

    public function addcourse(){
        $data = [
            'instruktur' => $this->AdminModel->getInstrukturData(),
        ];
        return view('admin/addcourse', $data);
    }

    public function addNewCourse(){
        Request()->validate([
            'id' => 'required|string|min:6|max:10|unique:courses,courseID',
            'courseName' => 'required|string|max:255|unique:courses,courseName',
            'instruktur' => 'required',
        ]);

        $data = [
            'courseID' => Request()->id,
            'courseName' => Request()->courseName,
            'instrukturID' => Request()->instruktur
        ];

        $this->AdminModel->addNewCourse($data);
        Request()->session()->flash('success','Add New Course Success!!');
        return redirect()->route('addcourse');
    }

    public function coursesList(){
        $data = [
            'course' => $this->AdminModel->getCourseData(),
            'member' => $this->AdminModel->getMemberData()
        ];
        return view('admin/coursesList', $data);
    }
}
