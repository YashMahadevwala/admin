<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\semester;
use Illuminate\Support\Facades\DB;
use Semester as GlobalSemester;

class semesterController extends Controller
{
    public function addsemester()
    {
        return view('admin.addsem');
    }

    public function storesemester(Request $request)
    {
        $valid = $request->validate([
            'semestername' => 'required',
            'active' => 'required',

        ]);
        // return $request;
        if ($valid) {
            
            $addsem = new semester;

            $addsem->semestername = $request->semestername;
            $addsem->is_active = $request->active;
            $addsem->save();

            return redirect()->route('admin.semesters.list');

        }
    }

    public function semesterlist()
    {
        $sem = semester::all();
        return view('admin.semlist',['sems'=>$sem]);
    }

    public function editsemester($id)
    {
        $sems = semester::find($id);
        // return $user;
        return view('admin.addsem',['sems'=>$sems]);
    }

    public function updatesemester(Request $request)
    {
        $valid = $request->validate([
            'semestername' => 'required',
            'active' => 'required',

        ]);
        // return $request;
        if ($valid) {
            
            $updatesemester = new semester;
            $updatesemester = semester::find($request->id);

            $updatesemester->semestername = $request->semestername;
            $updatesemester->is_active = $request->active;
            $updatesemester->save();

            return redirect()->route('admin.semesters.list');

        }

    }

    public function deletesemester($id)
    {
        $semester = semester::find($id);
        $semester->delete();
        // return $semester;
        return redirect()->route('admin.semesters.list');
    }

  
}
