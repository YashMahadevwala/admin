<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    
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
            $adduser->is_approve = 0;
            $file = $request->file('avtar');
            if ($file) {
                $destinationPath = 'images/';
                $adduser->avtar = $file->getClientOriginalName();
                $file->move($destinationPath,$file->getClientOriginalName());
            }
            $adduser->save();
            $id = $adduser->id;
            // return $id;
            $data = [
                'subject' => 'Set your Password',
                'email' => $request->email,
                'id' => $id
            ];
    
            Mail::send('mail.faculty_mail', $data, function($message) use ($data) {
                $message->to($data['email'])
                ->subject($data['subject']);
              });
      
            
            return redirect()->route('admin.users.list')->with('success','data saved !');

        }

        // return $request;
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

            return redirect()->route('admin.users.list')->with('updated','Data Updated !');
        // }
        
        // return $request->id;
        // return $user;

    }

    public function deleteuser($id)
    {
        $user = user::find($id);
        $user->delete();
        // return $user;
        return redirect()->route('admin.users.list')->with('danger','Data Deleted !');
    }

    

}
