<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MemberModel extends Model
{
    use HasFactory;

    public function getCourseData(){
        return DB::table('courses')
                ->join('users','courses.instrukturID','=','users.id')
                ->get();
    }

    public function getCourseMemberData(){
        return DB::table('coursemembers')
                ->get();
    }

    public function enrollCourse($data){
        DB::table('coursemembers')->insert($data);
    }

    public function courseList(){
        return view('courseList');
    }

    public function getCourseAssignment($courseID){
        return DB::table('assignments')
                ->where('courseID',$courseID)
                ->get();
    }

    public function getAssLog(){
        return DB::table('assignmentlog')
                ->get();
    }

    public function addSubmission($data){
        DB::table('assignmentlog')->insert($data);
    }

    public function getUserDataByID($memberID){
        return DB::table('users')
                ->where('id',$memberID)
                ->first();
    }

    public function updatePoint($memberID,$dataPoint){
        DB::table('users')->where('id',$memberID)->update($dataPoint);
    }

    public function getLeaderboards(){
        return DB::table('users')
                ->orderBy('point','DESC')
                ->get();
    }

    public function pointLog($pointLog){
        DB::table('pointlog')->insert($pointLog);
    }

    public function attendanceLog($dataAttend){
        DB::table('attendancelog')->insert($dataAttend);
    } 

    public function getAttendanceLog(){
        return DB::table('attendancelog')->get();
    }
}
