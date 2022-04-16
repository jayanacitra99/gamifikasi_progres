<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\InstrukturModel;
use Illuminate\Http\Request;

class InstrukturController extends Controller
{
    //
    public function __construct()
    {
        $this->AdminModel = new AdminModel();
        $this->InstrukturModel = new InstrukturModel();
        if($this->middleware('auth')){
            $this->middleware('instruktur');
        }
    }

    public function index(){
        return view('instruktur/dashboard');
    }

    public function course(){
        $id = auth()->user()->id;
        $data = [
            'course' => $this->InstrukturModel->getCourseDataById($id),
            'member' => $this->AdminModel->getMemberData()
        ];
        return view('instruktur/courseLinked',$data);
    }

    public function detailCourse($id){
        $data = [
            'course'     => $this->AdminModel->getCourseDataById($id),
            'assignment' => $this->InstrukturModel->getDetailCourse($id),
        ];
        return view ('instruktur/detailCourse',$data);
    }

    public function addAssignment($id){
        $data = [
            'course'     => $this->AdminModel->getCourseDataById($id),
        ];
        return view ('instruktur/addAssignments',$data);
    }

    public function addAssignmentData($courseID){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        Request()->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'type' => 'required',
        ]);

        if(Request()->file('files') != NULL){
            foreach (Request()->file('files') as $file) {
                $filename = Request()->type.'_'.pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME).'_'.time().'.'.$file->extension();
                $file->move(public_path('assignments'),$filename);
                $allfiles[] = $filename;
            }
            $inputFile = serialize($allfiles);
        } else {
            $inputFile = NULL;
        }

        $data = [
            'courseID'      => $courseID,
            'title'         => Request()->title,
            'description'   => Request()->desc,
            'files'         => $inputFile,
            'link'          => Request()->url,
            'start_date'    => Request()->start,
            'end_date'      => Request()->end,
            'types'         => Request()->type,
            'a_exp'         => Request()->a_exp,
            'a_point'       => Request()->a_point,
        ];

        $this->InstrukturModel->addAssignmentData($data);
        Request()->session()->flash('success','Add New '.Request()->type.' Success!!');
        return redirect()->route('courseLinked');
    }

    public function detailAssignment($courseID, $assignmentID){
        $data = [
            'assignmentID'  => $assignmentID,
            'member'        => $this->InstrukturModel->getMemberData($courseID),
            'assignmentlog' => $this->InstrukturModel->getAssignmentLog(),
            'assignment'    => $this->InstrukturModel->getDetailCourse($courseID)
        ];
        return view('instruktur/detailAssignment',$data);
    }

    public function gradeAssignment($assLogID,$grade){
        date_default_timezone_set('Asia/Jakarta');
        $timestamp = date('Y-m-d H:i:s');
        $data = [
            'grades' => $grade,
            'updated_at'    => $timestamp
        ];

        $this->InstrukturModel->gradeAssignment($assLogID,$data);
        Request()->session()->flash('success','Grading Success!!');
        return redirect()->back();
    }

    public function completeMember($courseMemberID){
        $data = [
            'status' => 'COMPLETE',
        ];

        $this->InstrukturModel->statusMember($courseMemberID,$data);
        Request()->session()->flash('success','Completed!!');
        return redirect()->back();
    }

    public function approveMember($courseMemberID){
        $data = [
            'status' => 'ONGOING',
        ];

        $this->InstrukturModel->statusMember($courseMemberID,$data);
        Request()->session()->flash('success','Approved!!');
        return redirect()->back();
    }

    public function editAssignment($assignmentID){
        $data = [
            'assignment' => $this->InstrukturModel->getAssignmentDataByID($assignmentID),
        ];

        return view('instruktur/editAssignment', $data);
    }

    public function editAssignmentData($assignmentID){
        $assignment = $this->InstrukturModel->getAssignmentDataByID($assignmentID);
        Request()->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
        ]);

        // if(Request()->file('files') != NULL){
        //     foreach (Request()->file('files') as $file) {
        //         $filename = Request()->type.'_'.pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME).'_'.time().'.'.$file->extension();
        //         $file->move(public_path('assignments'),$filename);
        //         $allfiles[] = $filename;
        //     }
        //     $inputFile = serialize($allfiles);
        // } else {
        //     $inputFile = NULL;
        // }

        $data = [
            'title'         => Request()->title,
            'description'   => Request()->desc,
            // 'files'         => $inputFile,
            'link'          => Request()->url,
            'start_date'    => Request()->start,
            'end_date'      => Request()->end,
            'a_exp'         => Request()->a_exp,
            'a_point'       => Request()->a_point,
        ];

        $this->InstrukturModel->editAssignmentData($assignmentID,$data);
        Request()->session()->flash('success','Edit Assignment Success!!');
        return redirect(url('detailCourse/'.$assignment->courseID));
    }

    public function deleteAssignment($assignmentID){
        $assignment = $this->InstrukturModel->getAssignmentDataByID($assignmentID);
        $this->InstrukturModel->deleteAssignment($assignmentID);
        Request()->session()->flash('success', 'Assignment Deleted!!');
        return redirect(url('detailCourse/'.$assignment->courseID));
    }
}
