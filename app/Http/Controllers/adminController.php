<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'fullname' => 'reuired | min:4',
            'email' => 'reuired | email',
            'password' => 'reuired | min:6',
            'confirm_password' => 'reuired | min:6 | same:password',
        ]);

        if ($valid) {
            return 'hello';
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
