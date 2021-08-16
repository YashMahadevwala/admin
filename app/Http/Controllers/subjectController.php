<?php

namespace App\Http\Controllers;
use App\Models\semester;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use App\Models\role;
use App\Models\subject;

use Illuminate\Http\Request;

class subjectController extends Controller
{
    //
    public function subjectlist()
    {
        
        return view('admin.sublist');
    }

    public function addsubject()
    {
        $sems = semester::where('is_active','active')->get();
        // return $sems;
        $fac = user::where('role_no','=',4)->get();
        // return $fac;
        return view('admin.addsub',['data'=>$sems,'fac'=>$fac]);
    }

    public function storesubject(Request $request)
    {
        // return $request;
        $valid = $request->validate([
            'subjectname' => 'required',

        ]);
        // return $request;
        if ($valid) {
            // return $request;
            $addsub = new subject;

            $addsub->subjectname = $request->subjectname;
            $addsub->is_active = $request->active;
            $addsub->type = $request->type;
            $addsub->semester = $request->sem;
            $addsub->faculty = $request->faculty;
            $addsub->save();

            // return redirect()->route('admin.subjects.list')->with('success','data saved !');
            return response()->json(['success'=>'Data Saved Successfully !']);


        }
    }

    public function editsubject($id)
    {
        $sub = subject::find($id);
        // return $sub;
        $fac = user::where('role_no','=',4)->get();
        // return $fac;
        $sems = semester::all();
        return view('admin.addsub',['sub'=>$sub,'fac'=>$fac,'data'=>$sems]);
    }

    public function updatesubject(Request $request)
    {
        $valid = $request->validate([
            'subjectname' => 'required',

        ]);
        // return $request;
        if ($valid) {
            // return $request;
            $updatesub = new subject;
            $updatesub = subject::find($request->id);
            $updatesub->subjectname = $request->subjectname;
            $updatesub->is_active = $request->active;
            $updatesub->type = $request->type;
            $updatesub->semester = $request->sem;
            $updatesub->faculty = $request->faculty;
            $updatesub->save();

            // return redirect()->route('admin.subjects.list')->with('updated','Data Updated !');
            return response()->json(['success'=>'Data Updated Successfully !']);


        }

    }

    public function deletesubject($id)
    {
        $subject = subject::find($id);
        $subject->delete();
        // return $subject;
        // return redirect()->route('admin.subjects.list')->with('danger','Data Deleted !');
        return response()->json(['success'=>'Data Deleted Successfully !']);

    }

    public function showdata(Request $request)
    {
        
        // $sem = semester::get();
        // $subs = subject::select('subjects.*','user.firstname','user.lastname')
        // ->where('user.id','=','subjects.faculty')
        // ->get();
        $subs = DB::table('subjects')
            ->join('user', 'user.id', '=', 'subjects.faculty')
            ->join('semester', 'semester.id', '=', 'subjects.semester')
            ->select('subjects.*', 'user.firstname','user.lastname','semester.semestername')
            ->get();
        // dd($subs);
        // die;
        return Datatables()->of($subs)
            ->addIndexColumn()
            ->editColumn('faculty', function ($subs) {
                return $subs->firstname.' '.$subs->lastname;
                 }) 
            // ->addColumn('status', function($subs) {
            //     return ($subs->is_active == "active") ? 'Active' : 'Deactive';
            // })
            // ->addColumn('action', function($subs) {
            //     return '<a type="button" href="/admin/subjects/edit/'.$subs->id .'" class="btn btn-warning">Edit</a>
            //     <a type="button" delete-url="/admin/subjects/delete/" data-id="'. $subs->id .'" href="/admin/users/delete/'.$subs->id .'" class="btn-del btn btn-danger">Delete</a>';
            // })
            // ->editColumn('delete', 'Delete')
            ->make(true);
    }


    public function change_status(Request $request)
    {
        // dd($request->original);
        
        // dd($change);
        if($request->val == 'yes'){
            $change = new subject;
            $change = subject::find($request->id);
            $change->is_active = 'active';
            $change->save();
            $re = true;
        }else{
            $change = new subject;
            $change = subject::find($request->id);
            $change->is_active = 'deactive';
            $change->save();
        }
            return response()->json(['success'=>'Status Changed !']);

    }


}
