<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;
use App\Models\role;
use App\Models\user;
use Illuminate\Support\Facades\DB;


class adminController extends Controller
{
    public function register()
    {
        return view('admin.registration');
    }

    public function store(Request $request)
    {
        // return $request;
        $valid = $request->validate([
            'fullname' => 'required | min:4',
            'email' => 'required | email | unique:admin,email',
            'password' => 'required | min:4',
            'confirm_password' => 'required | min:4 | same:password',
        ]);

        if ($valid) {
            // return 'hello';
            if ($request->terms == '') {
                return back()->with('termFail','Accept term & condition');
            }else{
            $admin = new admin;
            $admin->fullname = $request->fullname;
            $admin->email = $request->email;
            $admin->password = Hash::make($request->password);
            $admin->save();
            return redirect('login')->with('success','Registration Succesfull !');
            }
            
        }
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginCheck(Request $request)
    {
        // return $request;
        $valid = $request->validate([
            'email' => 'required | email',
            'password' => 'required | min:4',
        ]);

        if ($valid) {
            $data = admin::where('email','=',$request->email)->first();
            if (!$data) {
                return back()->with('failEmail','Email Not Found');
            }else{
                if (!Hash::check($request->password, $data->password)) {
                    return back()->with('failPass','Password Not Match');
                }else{
                    $request->session()->put('fullname',$data->fullname);
                    $request->session()->put('uid', $data->id);
                    // return $request->session()->get('fullname');
                    // return $request->session()->get('uid');
                    return redirect('dashboard');

                }
            }
        }
    }

    public function logout()
    {
        session()->forget('fullname');
        session()->forget('uid');
        return redirect('login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function adduser()
    {
        $data = role::all();
        // return $data;
        return view('admin.adduser',['role'=>$data]);
    }

    public function storeuser(Request $request)
    {
        $valid = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required | email',
            'mobile' => 'required | numeric | digits:10',
            // 'avtar' => 'required',

        ]);
        // return $valid;
        if ($valid) {
            
            $adduser = new user;

            $adduser->firstname = $request->firstname;
            $adduser->lastname = $request->lastname;
            $adduser->email = $request->email;
            $adduser->mobile = $request->mobile;
            $adduser->role_no = $request->role;
            $file = $request->file('avtar');
            if ($file) {
                $destinationPath = 'images/';
                $adduser->avtar = $file->getClientOriginalName();
                $file->move($destinationPath,$file->getClientOriginalName());
            }
            $adduser->save();

            return redirect('userlist');

        }

        return $request;
    }

    public function userlist()
    {
        // $data = user::all();
        $data = DB::table('user')
            ->join('role', 'user.role_no', '=', 'role.role_id')
            ->select('user.*', 'role.*')
            ->get();
        // return $data;
        return view('admin.userlist',['users'=>$data]);
    }

    public function edituser($id)
    {
        $user = user::find($id);
        // return $user;
        $role = role::all();
        return view('admin.adduser',['user'=>$user,'role'=>$role]);
    }

    public function updateuser(Request $request)
    {
        $valid = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required | email',
            'mobile' => 'required | numeric | digits:10',
            // 'avtar' => 'required',

        ]);
        // if ($valid) {
            $updateuser = new user;
            $updateuser = user::find($request->id);

            $updateuser->firstname = $request->firstname;
            $updateuser->lastname = $request->lastname;
            $updateuser->email = $request->email;
            $updateuser->mobile = $request->mobile;
            $updateuser->role_no = $request->role;
            $file = $request->file('avtar');
            if ($file) {
                $destinationPath = 'images/';
                $updateuser->avtar = $file->getClientOriginalName();
                $file->move($destinationPath,$file->getClientOriginalName());
            }
            $updateuser->save();

            return redirect('userlist');
        // }
        
        // return $request->id;
        // return $user;

    }

    public function deleteuser($id)
    {
        $user = user::find($id);
        $user->delete();
        // return $user;
        return redirect('userlist');
    }

    public function semesterlist()
    {
        return view('admin.semlist');
    }

    public function addsemester()
    {
        return view('admin.addsem');
    }

    public function storesemester(Request $request)
    {
        return 'hello';
    }

}
