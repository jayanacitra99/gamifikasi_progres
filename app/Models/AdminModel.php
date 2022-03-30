<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    use HasFactory;

    public function addNewUser($data){
        DB::table('users')->insert($data);
    }

    public function addNewCourse($data){
        DB::table('courses')->insert($data);
    }

    public function getInstrukturData(){
        return DB::table('users')
                ->where('role','INSTRUKTUR')
                ->get();
    }

    public function getUserData(){
        return DB::table('users')
                ->get();
    }
    

    public function getCourseData(){
        return DB::table('courses')
                ->join('users','courses.instrukturID','=','users.id')
                ->get();
    }

    public function getCourseMemberData(){
        return DB::table('coursemembers')
                ->join('users','coursemembers.memberID','=','users.id')
                ->join('courses','coursemembers.courseID','=','courses.courseID')
                ->get();
    }

    public function getMemberData(){
        return DB::table('coursemembers')
                ->join('users','coursemembers.memberID','=','users.id')
                ->get();
    }

    public function getCourseDataById($id){
        return DB::table('courses')
                ->where('courseID',$id)
                ->first();
    }

    public function editCourseData($data,$id){
        DB::table('courses')->where('courseID',$id)->update($data);
    }

    public function deleteCourse($id){
        DB::table('courses')->where('courseID',$id)->delete();
    }

    public function getUserDataById($id){
        return DB::table('users')
                ->where('id',$id)
                ->first();
    }

    public function editUserData($data,$id){
        DB::table('users')->where('id',$id)->update($data);
    }

    public function deleteUser($id){
        DB::table('users')->where('id',$id)->delete();
    }
}
