<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function __construct()
    {
        $this->MemberModel = new MemberModel();
        if($this->middleware('auth')){
            $this->middleware('member');
        }
    }

    public function index(){
        return view('dashboard');
    }

    public function leaderboards(){
        $data = [
            'user'  => $this->MemberModel->getLeaderboards(),
        ];
        return view('leaderboards',$data);
    }

    public function enrollCourse(){
        $data = [
            'course'        => $this->MemberModel->getCourseData(),
            'coursemember'  => $this->MemberModel->getCourseMemberData()
        ];
        return view('enrollCourse', $data);
    }

    public function enroll($courseID,$memberID){
        $data = [
            'memberID' => $memberID,
            'courseID' => $courseID,
            'status' => 'ONGOING',
        ];
        $this->MemberModel->enrollCourse($data);
        Request()->session()->flash('success','Enroll Success!!');
        return redirect()->route('courseList');
    }

    public function courseList(){
        $data = [
            'course'        => $this->MemberModel->getCourseData(),
            'coursemember'  => $this->MemberModel->getCourseMemberData()
        ];
        return view('courseList', $data);
    }

    public function courseDetail($courseID,$memberID){
        $data = [
            'assignment'    => $this->MemberModel->getCourseAssignment($courseID),
            'asslog'        => $this->MemberModel->getAssLog(),
            'memberID'      => $memberID
        ];
        return view('courseDetail', $data);
    }

    public function addSubmission($courseID,$assignmentID, $memberID){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        Request()->validate([
            'files' => 'required',
        ]);

        foreach (Request()->file('files') as $file) {
            $filename = $assignmentID.'_'.pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME).'_'.time().'.'.$file->extension();
            $file->move(public_path('assignmentlogs'),$filename);
            $allfiles[] = $filename;
        }

        $data = [
            'memberID'      => $memberID,
            'assignmentID'  => $assignmentID,
            'files'         => serialize($allfiles),
            'status'        => Request()->status,
            'created_at'    => $timestamp,
        ];

        $this->MemberModel->addSubmission($data);

        $user = $this->MemberModel->getUserDataByID($memberID);

        if (Request()->status == 'DONE') {
            $point = $user->point + 500;
            $level = floor($point / 1000);
            if ($level <= 5) {
                $badge = 'BRONZE';
            } else if (($level > 5) && ($level <= 10)) {
                $badge = 'SILVER';
            } else if (($level > 10) && ($level <= 15)) {
                $badge = 'GOLD';
            } else if (($level > 15) && ($level <= 20)) {
                $badge = 'PLATINUM';
            }
            
        } else {
            $point = $user->point - 100;
            $level = floor($point / 1000);
            if ($level <= 5) {
                $badge = 'BRONZE';
            } else if (($level > 5) && ($level <= 10)) {
                $badge = 'SILVER';
            } else if (($level > 10) && ($level <= 15)) {
                $badge = 'GOLD';
            } else if (($level > 15) && ($level <= 20)) {
                $badge = 'PLATINUM';
            }
        }

        $dataPoint = [
            'point'     => $point,
            'levels'    => $level,
            'badges'    => $badge,
            'updated_at'=> $timestamp
        ];

        $this->MemberModel->updatePoint($memberID,$dataPoint);
        Request()->session()->flash('success','Submit Success!!');
        return redirect(url('courseDetail/'.$courseID.'/'.$memberID));
    }
}
