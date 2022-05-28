<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'day'       => 'required',
            'start'     => 'required',
            'end'     => 'required',
            'date'      => 'required',
        ]);

        $data = [
            'courseID' => Request()->id,
            'courseName' => Request()->courseName,
            'instrukturID' => Request()->instruktur,
            'day'   => Request()->day,
            'start_time'    => Request()->start,
            'end_time'    => Request()->end,
            'start_date'    => Request()->date,
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

    public function editCourse($id){
        $data = [
            'course'        => $this->AdminModel->getCourseDataById($id),
            'instruktur'    => $this->AdminModel->getInstrukturData()
        ];
        return view('admin/editCourse', $data);
    }

    public function editCourseData($id){
        $course = $this->AdminModel->getCourseDataById($id);
        Request()->validate([
            'id' => 'required|string|min:6|max:10'.($course->instrukturID === Request()->id) ? '' : '|unique:courses,courseID',
            'courseName' => 'required|string|max:255'.($course->courseName === Request()->courseName) ? '' : '|unique:courses,courseName',
            'instruktur' => 'required',
        ]);

        $data = [
            'courseID' => Request()->id,
            'courseName' => Request()->courseName,
            'instrukturID' => Request()->instruktur
        ];

        $this->AdminModel->editCourseData($data,$id);
        Request()->session()->flash('success','Edit Course Success!!');
        return redirect()->route('coursesList');
    }

    public function deleteCourse($id){
        $this->AdminModel->deleteCourse($id);
        Request()->session()->flash('success', 'Course Deleted!!');
        return redirect()->route('coursesList');
    }

    public function userList(){
        $data['user'] = $this->AdminModel->getUserData();
        return view('admin/userList', $data);
    }

    public function editUser($id){
        $data['user'] = $this->AdminModel->getUserDataById($id);
        return view('admin/editUser',$data);
    }

    public function editUserData($id){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        $user = $this->AdminModel->getUserDataById($id);

        Request()->validate([
            'name'      => 'required|string|max:255',
            'role'      => 'required',
            'email'     => 'required|string|email|max:255'.($user->email === Request()->email) ? '':'|unique:users,email',
            'badges'    => 'required',
            'level'    => 'required',
            'point'     => 'required|min:0|max:10000',
        ]);

        $data = [
            'name' => Request()->name,
            'role' => Request()->role,
            'email' => Request()->email,
            'badges' => Request()->badges,
            'levels' => Request()->level,
            'point' => Request()->point,
            'updated_at' => $timestamp,
        ];

        $this->AdminModel->editUserData($data,$id);
        Request()->session()->flash('success','User Edited!!');
        return redirect()->route('userList');
    }

    public function deleteUser($id){
        $user = $this->AdminModel->getUserDataById($id);
        if($user->role == 'INSTRUKTUR'){
            $course = $this->AdminModel->getCourseData();
            foreach ($course as $instruktur) {
                if($instruktur->instrukturID == $id){
                    Request()->session()->flash('notif', 'Instructure Still Have a Course!!');
                    return redirect()->back();
                } else {
                    if($user->photo <> ""){
                        unlink(public_path('profiles').'/'.$user->photo);
                    }
                    $this->AdminModel->deleteUser($id);
                    Request()->session()->flash('success', 'User Deleted!!');
                    return redirect()->route('userList');
                }
            }
        } else if($user->role == 'PESERTA'){
            $coursemember = $this->AdminModel->getCourseMemberData();
            foreach ($coursemember as $member) {
                if(($member->memberID == $id) && ($member->status == 'ONGOING')){
                    Request()->session()->flash('notif', 'Member Still Have an Ongoing Course!!');
                    return redirect()->back();
                } else {
                    if($user->photo <> ""){
                        unlink(public_path('profiles').'/'.$user->photo);
                    }
                    $this->AdminModel->deleteUser($id);
                    Request()->session()->flash('success', 'User Deleted!!');
                    return redirect()->route('userList');
                }
            }
        } else {
            if($user->photo <> ""){
                unlink(public_path('profiles').'/'.$user->photo);
            }
            $this->AdminModel->deleteUser($id);
            Request()->session()->flash('success', 'User Deleted!!');
            return redirect()->route('userList');
        }
    }

    public function completeMemberByAdmin($courseMemberID){
        $data = [
            'status' => 'COMPLETE',
        ];

        $this->AdminModel->statusMember($courseMemberID,$data);
        Request()->session()->flash('success','Completed!!');
        return redirect()->back();
    }

    public function changePass($userid,$pass){
        $data = [
            'password' => Hash::make($pass),
        ];

        $this->AdminModel->editUserData($data,$userid);
        Request()->session()->flash('success','Change Password Success!!');
        return redirect()->back();
    }
}
