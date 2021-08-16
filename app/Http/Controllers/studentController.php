<?php

namespace App\Http\Controllers;

use App\Models\semester;
use Illuminate\Http\Request;
use App\Models\subject;
use App\Models\student;
use App\Models\students_subjects;
use Illuminate\Support\Facades\DB;
use Students;
use Subjects;

class studentController extends Controller
{
    //
    public function studentlist()
    {
        return view('admin.studlist');
    }

    public function addstudent()
    {
        $sems = semester::get();
        $subs = subject::select('subjectname','id')->where('is_active','active')->get();
        return view('admin.addstud',['sems'=>$sems,'subs'=>$subs]);
    }

    public function storestudent(Request $request)
    {
        $valid = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required | email',
            'dateofbirth' => 'required',
            'passingyear' => 'required',
            'semester' => 'required',
            'subjects' => 'required',
            'age' => 'required',
            'avtar' => 'image | mimes:jpeg,png,jpg,gif,svg',

        ]);
        // return $request;
        if ($valid) {
            
            $addstud = new student;
            

            $addstud->firstname = $request->firstname;
            $addstud->lastname = $request->lastname;
            $addstud->email = $request->email;
            $addstud->address = $request->address;
            $addstud->dateofbirth = $request->dateofbirth;
            $addstud->passingyear = $request->passingyear;
            $addstud->semester = $request->semester;
            $addstud->age = $request->age;
            $file = $request->file('avtar');
            $destination = 'adminUploadImages/';
            if(!$file){

            }else{
                $addstud->avtar = $file->getClientOriginalName();
                $file->move($destination,$file->getClientOriginalName());
            }
            $addstud->save();
            
            $subjects_selected = $request->subjects;
            $sid = $addstud->id;
            foreach($subjects_selected as $key => $val){
                $addstud_sub = new students_subjects;
                $addstud_sub->student_id = $sid;
                $addstud_sub->subjects = $val;
                $addstud_sub->save();
                // echo $val . ' <---> ' . $addstud_sub->id . '<br>';
            }

            // $addstud->subjects = json_encode($request->subjects);
            // $id = $addstud->id;
            // $addstud_sub->student_id = $id;
            // $addstud_sub->subjects = req
            

            // return redirect()->route('admin.semesters.list')->with('success','data saved !');
            return response()->json(['success'=>'Data Saved Successfully !']);

            // dd($request->avtar);
            // dd($request->file('avtar'));
            // $en = json_encode($request->subjects);
            // dd($en);
            // return;
            // dd(json_decode($en));
            // return;

        }
    }

// edit call normally like laravel default methods
    public function editstudent($id)
    {
        // $stud = student::with('getsubjects')->get();
        $stud = student::find($id)->with('getsubjects')->get()->first();
        // $data=member::find(1)->with('company')->get()->first();
        // dd($stud);
        // ->join('students_subjects', 'students_subjects.student_id', '=', 'students.id')
        // ->select('students.*','students_subjects.subjects')
        // ->get();
        // dd($stud);
        $sems = semester::get();
        $subs = subject::select('subjectname','id')->get();
        // dd($data);
        return view('admin.addstud',['stud'=>$stud,'sems'=>$sems,'subs'=>$subs]);
        // return response()->json(['html'=>$html,'success'=>'Data Fetch Successfully !']);
        // $html = \view::make('admin.addstud',$data);
        // $html = view('admin.addstud', compact('stud'))->render();
        // echo $html;
    }


    public function updatestudent(Request $request)
    {
        $valid = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required | email',
            'dateofbirth' => 'required',
            'passingyear' => 'required',
            'semester' => 'required',
            'subjects' => 'required',
            'age' => 'required',
            'avtar' => 'image | mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($valid) {
            // return $request;
            $updatestud = new student;
            $updatestud = Student::find($request->id);
            $updatestud->firstname = $request->firstname;
            $updatestud->lastname = $request->lastname;
            $updatestud->email = $request->email;
            $updatestud->address = $request->address;
            $updatestud->dateofbirth = $request->dateofbirth;
            $updatestud->passingyear = $request->passingyear;
            $updatestud->semester = $request->semester;
            $updatestud->age = $request->age;
            $file = $request->file('avtar');
            $destination = 'adminUploadImages/';
            if(!$file){

            }else{
                $updatestud->avtar = $file->getClientOriginalName();
                $file->move($destination,$file->getClientOriginalName());
            }
            $updatestud->save();

            $update_subjects_selected = $request->subjects;
            $sid = $updatestud->id;
            // dd($sid);
            foreach($update_subjects_selected as $key => $val){
                $update_stud_sub = new students_subjects;
                $update_stud_sub = students_subjects::where('student_id',$sid)->first();
                // dd($update_stud_sub);
                $update_stud_sub->subjects = $val;
                $update_stud_sub->save();
                // echo $val . ' <---> ' . $addstud_sub->id . '<br>';
            }
            // return redirect()->route('admin.subjects.list')->with('updated','Data Updated !');
            return response()->json(['success'=>'Data Updated Successfully !']);


        }

    }




    public function showdata(Request $request)
    {
        // $stud = DB::table('students')
        //         ->join('semester', 'semester.id', '=', 'students.semester')
        //         ->join('students_subjects', 'students_subjects.student_id', '=', 'students.id')
        //         ->join('subjects', 'subjects.id', '=', 'students_subjects.subjects')
        //         ->select('students.*', 'semester.semestername as sem_name','students_subjects.subjects','subjects.subjectname')
        //         ->get();
                //         // ->groupBy('students.id')
                $stud = student::with('getsubjects')->get();
                // return dd($stud);
                // return $stud;
                // $stud = DB::table('getsubjects')->get();
                // dd($stud);
                // ->select('students.*')
                // die;
                // return $stud;
                // $data = student::get()->getsubjects();
                // return $data;



                return datatables()->of($stud)
                ->addIndexColumn()
                ->editColumn('semester', function($stud) {
                    // return 'Hi '. $stud->id .'!';
                    return getSemesterNameForStudentRecord($stud->semester);
                })
                // ->editColumn('subjects', function($stud) {
                //     // return 'Hi '. $stud->id .'!';
                //     return getSemesterNameForStudentRecord($stud->semester);
                // })
                ->editColumn('subjects', function($stud) {
                    // return 'Hi '. $stud->getsubjects[0]->subjects .'!';
                    $subject_ids = array();
                    foreach($stud->getsubjects as $subject){
                        array_push($subject_ids, getSubjectsNameForStudentRecord($subject->subjects));
                        // array_push($subject_ids, $subject->subjects);
                        // return $subject->subjects ;
                        // return getSubjectsNameForStudentRecord($subject->subjects);
                    }
                    return implode(', ', $subject_ids);
                })
                ->addColumn('action', function($stud) {
                    // href="/admin/students/edit/'. $stud->id .'"
                    return '<a type="button" class="btn btn-warning" edit-url="/admin/students/edit/" href="/admin/students/edit/'. $stud->id .'" data-id="'. $stud->id .'">Edit</a>
                    <a type="button" delete-url="/admin/students/delete/" data-id="'. $stud->id .'" class="btn-del-user btn btn-del btn-danger">Delete</a>';
                })
                ->make(true);
            }
            // ->join('students_subjects', 'students_subjects.student_id', '=', 'students.id')
            // ,'students_subjects.subjects')
            
            // ->addColumn('status', function($stud) {
                //     return ($stud->is_active == "active") ? 'Active' : 'Deactive';
                // })

                // ->editColumn('delete', 'Delete')
                //  class='btn-del-user btn btn-danger'

            public function deletestudent($id)
            {
                $stud = student::find($id);
                $stud->delete();
                // return $semester;
                // return redirect()->route('admin.semesters.list')->with('danger','Data Deleted !');
                return response()->json(['success'=>'Data Deleted Successfully !']);

            }
}
