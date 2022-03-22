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

    public function getCourseData(){
        return DB::table('courses')
                ->join('users','courses.instrukturID','=','users.id')
                ->get();
    }

    public function getMemberData(){
        return DB::table('coursemembers')
                ->join('users','coursemembers.memberID','=','users.id')
                ->get();
    }
}
