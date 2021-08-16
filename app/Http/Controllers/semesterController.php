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

            // return redirect()->route('admin.semesters.list')->with('success','data saved !');
            return response()->json(['success'=>'Data Saved Successfully !']);

        }
    }

    public function semesterlist()
    {
        // $sem = semester::paginate(5);
        return view('admin.semlist');
        // ,['sems'=>$sem]
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
            // return $updatesemester;
            $updatesemester->semestername = $request->semestername;
            $updatesemester->is_active = $request->active;
            $updatesemester->save();

            // return redirect()->route('admin.semesters.list')->with('updated','Data Updated !');
        return response()->json(['success'=>'Data Updated Successfully !']);


        }

    }

    public function deletesemester($id)
    {
        $semester = semester::find($id);
        $semester->delete();
        // return $semester;
        // return redirect()->route('admin.semesters.list')->with('danger','Data Deleted !');
        return response()->json(['success'=>'Data Deleted Successfully !']);

    }

    public function showdata(Request $request)
    {
        // $users = DB::table('user')->select('*');
        $statusGreenBtn = '<i class="fas fa-circle" style="color: green"></i>';
        $statusRedBtn = '<i class="fas fa-circle" style="color: red"></i>';
        $sem = semester::get();
        return datatables()->of($sem)
            ->addIndexColumn()
            // ->addColumn('status', function($sem) {
            //     // return ($sem->is_active == "active") ? 'Active' : 'Deactive';
            //     return '{{!! <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1"> !!}}';
            // })
            // ->addColumn('status', function ($item) {
            //     return '<input type="checkbox" id="" name="someCheckbox" />';
            //   })
            // ->editColumn('status', function($sem) {
                // if(data_rem->is_strike) {
                    // $html = $data_rem->data;
                // }
                // else {
                    // fix this
                    // return '<input type="checkbox" class="sem-check" data-id="'. $sem->id .'" name="semester-check" '. ($sem->is_active == 'active' ? 'checked' : '') .' />';
                // }
                // return $html;
            // })
            // ->rawColumns(['status'])
            // ->editColumn('action', function($sem) {
            //     return '<a type="button" href="/admin/semesters/edit/'.$sem->id .'" class="btn btn-warning">Edit</a>
            //     <a type="button" delete-url="/admin/semesters/delete/" data-id="'. $sem->id .'" href="/admin/users/delete/'.$sem->id .'" class="btn-del btn btn-danger">Delete</a>';
            // })
            // ->rawColumns(['action'])

            // ->addColumn('action', function($sem) {
            //     return '<a type="button" href="/admin/semesters/edit/'.$sem->id .'" class="btn btn-warning">Edit</a>
            //     <a type="button" delete-url="/admin/semesters/delete/" data-id="'. $sem->id .'" href="/admin/users/delete/'.$sem->id .'" class="btn-del btn btn-danger">Delete</a>';
            // })
            // ->editColumn('delete', 'Delete')
            ->make(true);
    }
    

    public function change_status(Request $request)
    {
        // dd($request->original);
        
        // dd($change);
        if($request->val == 'yes'){
            $change = new semester;
            $change = semester::find($request->id);
            $change->is_active = 'active';
            $change->save();
            $re = true;
        }else{
            $change = new semester;
            $change = semester::find($request->id);
            $change->is_active = 'deactive';
            $change->save();
        }
            return response()->json(['success'=>'Status Changed !']);

    }
  
}
