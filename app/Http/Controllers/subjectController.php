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
        $data = subject::all();
        // return $data;
        // dd( $data);
        return view('admin.sublist',['subs'=>$data]);
    }

    public function addsubject()
    {
        $sems = semester::all();
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

            return redirect()->route('admin.subjects.list')->with('success','data saved !');

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

            return redirect()->route('admin.subjects.list')->with('updated','Data Updated !');

        }

    }

    public function deletesubject($id)
    {
        $subject = subject::find($id);
        $subject->delete();
        // return $subject;
        return redirect()->route('admin.subjects.list')->with('danger','Data Deleted !');
    }

}
