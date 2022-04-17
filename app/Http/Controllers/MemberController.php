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
            'pointlog'  => $this->MemberModel->getPointLog(),
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
            'status' => 'WAITING',
        ];
        $this->MemberModel->enrollCourse($data);
        Request()->session()->flash('success','Please Wait For Instructure Aprroval');
        return redirect()->route('enrollCourse');
    }

    public function courseList(){
        $data = [
            'course'        => $this->MemberModel->getCourseData(),
            'coursemember'  => $this->MemberModel->getCourseMemberData(),
            'attend'        => $this->MemberModel->getAttendanceLog()
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
        $assignment = $this->MemberModel->getAssignmentDataByID($assignmentID);

        if (Request()->status == 'DONE') {
            $point = $assignment->a_point;
            $totalpoint = $user->point + $point;
            $exp = $assignment->a_exp;
            $totalexp = $user->exp + $exp;
            $level = floor($totalexp / 1000);
            if ($level >= 20) {
                $level = 20;
            }
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
            $point = -100;
            $totalpoint = $user->point + $point;
            $exp = $assignment->a_exp;
            $totalexp = $user->exp + $exp;
            $level = floor($totalexp / 1000);
            if ($level >= 20) {
                $level = 20;
            }
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
            'point'     => $totalpoint,
            'levels'    => $level,
            'exp'       => $totalexp,
            'badges'    => $badge,
            'updated_at'=> $timestamp
        ];

        $this->MemberModel->updatePoint($memberID,$dataPoint);

        $pointLog = [
            'memberID'  => $memberID,
            'points'    => $point,
            'exp'       => $exp,
            'info'      => 'ASSIGNMENT',
            'timestamp' => $timestamp
        ];

        $this->MemberModel->pointLog($pointLog);
        Request()->session()->flash('success','Submit Success!!');
        return redirect(url('courseDetail/'.$courseID.'/'.$memberID));
    }

    public function learnMore(){
        return view('learnMore');
    }

    public function attendCourse($courseID,$memberID,$late){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        $user = $this->MemberModel->getUserDataByID($memberID);

        if ($late == true) {
            $point = -100;
        } else {
            $point = 500;
        }
        $totalpoint = $user->point + $point;
        $exp = 200;
        $totalexp = $user->exp + $exp;
        $level = floor($totalexp / 1000);
        if ($level >= 20) {
            $level = 20;
        }
        if ($level <= 5) {
            $badge = 'BRONZE';
        } else if (($level > 5) && ($level <= 10)) {
            $badge = 'SILVER';
        } else if (($level > 10) && ($level <= 15)) {
            $badge = 'GOLD';
        } else if (($level > 15) && ($level <= 20)) {
            $badge = 'PLATINUM';
        }

        $dataPoint = [
            'point'     => $totalpoint,
            'levels'    => $level,
            'exp'       => $totalexp,
            'badges'    => $badge,
            'updated_at'=> $timestamp
        ];

        $this->MemberModel->updatePoint($memberID,$dataPoint);

        $pointLog = [
            'memberID'  => $memberID,
            'points'    => $point,
            'exp'       => $exp,
            'info'      => 'ATTENDANCE',
            'timestamp' => $timestamp
        ];

        $this->MemberModel->pointLog($pointLog);

        $dataAttend = [
            'courseID'  => $courseID,
            'memberID'  => $memberID,
            'timestamp' => $timestamp
        ];

        $this->MemberModel->attendanceLog($dataAttend);
        Request()->session()->flash('success','Check In Success');
        return redirect()->route('courseList');
    }

    public function claimReward($memberID,$reward){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        $user = $this->MemberModel->getUserDataByID($memberID);

        $point = $reward;
        $totalpoint = $user->point + $point;
        $exp = 200;
        $totalexp = $user->exp + $exp;
        $level = floor($totalexp / 1000);
        if ($level >= 20) {
            $level = 20;
        }
        if ($level <= 5) {
            $badge = 'BRONZE';
        } else if (($level > 5) && ($level <= 10)) {
            $badge = 'SILVER';
        } else if (($level > 10) && ($level <= 15)) {
            $badge = 'GOLD';
        } else if (($level > 15) && ($level <= 20)) {
            $badge = 'PLATINUM';
        }

        $dataPoint = [
            'point'     => $totalpoint,
            'levels'    => $level,
            'exp'       => $totalexp,
            'badges'    => $badge,
            'updated_at'=> $timestamp
        ];

        $this->MemberModel->updatePoint($memberID,$dataPoint);

        $pointLog = [
            'memberID'  => $memberID,
            'points'    => $point,
            'exp'       => $exp,
            'info'      => 'REWARD',
            'timestamp' => $timestamp
        ];

        $this->MemberModel->pointLog($pointLog);
        Request()->session()->flash('success','Claim Reward Success!!');
        return redirect()->route('leaderboards');
    }
}
