<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;


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
            return redirect()->route('admin.login')->with('success','Registration Succesfull !');
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
            'password' => 'required',
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
                    return redirect()->route('admin.dashboard');

                }
            }
        }
    }

    public function logout()
    {
        session()->forget('fullname');
        session()->forget('uid');
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    

    

}
