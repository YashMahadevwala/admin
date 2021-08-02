<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class lactureController extends Controller
{
    public function lacturelist()
    {
        return view('admin.laclist');
    }
}
