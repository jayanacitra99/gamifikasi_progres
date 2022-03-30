<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InstrukturModel extends Model
{
    use HasFactory;

    public function getCourseDataById($id){
        return DB::table('courses')
                ->where('instrukturID',$id)
                ->join('users','courses.instrukturID','=','users.id')
                ->get();
    }

    public function getDetailCourse($id){
        return DB::table('assignments')
                ->join('courses','assignments.courseID','=','courses.courseID')
                ->where('assignments.courseID',$id)
                ->get();
    }

    public function addAssignmentData($data){
        DB::table('assignments')->insert($data);
    }

    public function getMemberData($courseID){
        return DB::table('coursemembers')
                ->join('users','coursemembers.memberID','=','users.id')
                ->where('courseID', $courseID)
                ->get();
    }

    public function getAssignmentLog(){
        return DB::table('assignmentlog')
                ->join('assignments','assignmentlog.assignmentID','=','assignments.assignmentID')
                ->select('*','assignmentlog.files as filesubmitted')
                ->get();
    }

    public function gradeAssignment($assLogID,$data){
        DB::table('assigmentlog')->where('assignmentLogID',$assLogID)->update($data);
    }
}
