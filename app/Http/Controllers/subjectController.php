<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class subjectController extends Controller
{
    //
    public function subjectlist()
    {
        return view('admin.addsub');
    }
}
