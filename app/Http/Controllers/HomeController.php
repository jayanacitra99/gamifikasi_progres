<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->HomeModel = new HomeModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->role == 'ADMIN'){
            return redirect('admin');
        } else if (auth()->user()->role == 'INSTRUKTUR'){
            return redirect('instruktur');
        } else if (auth()->user()->role == 'PESERTA'){
            return redirect('member');
        }
    }

    public function updatePhone($id,$phone){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        $data = [
            'phone' => $phone,
            'updated_at'    => $timestamp
        ];
        $this->HomeModel->updateProfile($id,$data);
        Request()->session()->flash('success','Phone Number Updated!!');
        return redirect()->back();
    }

    public function updatePhoto($id){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        Request()->validate([
            'photo'           => 'required|mimes:jpg,jpeg,png|max:5120'
        ]);

        $photo = Request()->photo;
        $photoName = auth()->user()->id.'-profilepicture.'.$photo->extension();
        $photo->move(public_path('profiles'),$photoName);

        $data = [
            'photo'              => $photoName,
            'updated_at'        => $timestamp
        ];

        $this->HomeModel->updateProfile($id,$data);
        Request()->session()->flash('success','Photo Profile Updated!!');
        return redirect()->back();
    }
    
}
