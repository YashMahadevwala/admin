<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;

class setpasswordController extends Controller
{
    public function setpassword($id)
    {
        return view('admin.setpassword',['id'=>$id]);
    }

    public function setuppassword(Request $request)
    {
        // return $request;
        $valid = $request->validate([
            'password' => 'required | min:4',
            // 'confirm_password' => 'required_with:password | same:password | min:4 | confirmed'
            
        ]);

        $updatepass = new user;
        $updatepass = user::find($request->id);

        $updatepass->password = Hash::make($request->password);
        $updatepass->save();
        return view('user.welcome');
       
            
    }

    public function testencode()
    {
        $data = rtrim(strtr(base64_encode(20), '+/', '-_'), '=');
        echo "encode : " . $data . "<br>";
        // return urlencode(20);
        $decode = base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
        echo "decode :" . $decode;
    }

}
