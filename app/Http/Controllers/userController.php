<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\DataTables;

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
      
            
              return response()->json(['success'=>'Data Saved Successfully !']);
            // return redirect()->route('admin.users.list')->with('success','data saved !');
        }
    }

    public function userlist()
    {
        // $data = user::all();
        // $data = DB::table('user')
        //     ->join('role', 'user.role_no', '=', 'role.role_id')
        //     ->select('user.*', 'role.*')
        //     ->paginate(5);
        // // return $data;
        return view('admin.userlist');
        // ,['users'=>$data]
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

            // return redirect()->route('admin.users.list')->with('updated','Data Updated !');
        // }
        return response()->json(['success'=>'Data Updated Successfully !']);
        // return $request->id;
        // return $user;

    }

    public function deleteuser($id)
    {
        $user = user::find($id);
        $user->delete();
        // return $user;
        // return redirect()->route('admin.users.list')->with('danger','Data Deleted !');
        return response()->json(['success'=>'Data Deleted Successfully !']);

    }

    public function showdata(Request $request)
    {
        // $users = DB::table('user')->select('*');
        $statusGreenBtn = '<i class="fas fa-circle" style="color: green"></i>';
        $statusRedBtn = '<i class="fas fa-circle" style="color: red"></i>';
        $users = DB::table('user')
            ->join('role', 'user.role_no', '=', 'role.role_id')
            ->select('user.*', 'role.*')
            ->get();
        return Datatables::of($users)
            ->addIndexColumn()
            // ->addColumn('status', function($users) {
            //     return isset($users->password) ? 'Active' : 'Deactive';
            // })
            ->addColumn('action', function($users) {
                return '<a type="button" href="/admin/users/edit/'.$users->id .'" class="btn btn-warning">Edit</a>
                <a type="button" delete-url="/admin/users/delete/" data-id="'. $users->id .'" href="/admin/users/delete/'.$users->id .'" class="btn-del btn btn-danger" style="float:right">Delete</a>';
            })
            // delete-url="/admin/users/delete/" data-id="{{ $user->id }}"
            ->make(true);
    }
    

}
