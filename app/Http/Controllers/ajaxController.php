<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\semester;
use App\Models\subject;

class ajaxController extends Controller
{
    public function add()
    {
        $sem = semester::all();
        $sub = subject::all();
        return view('ajax.addcrud',['data'=>$sem,'subs'=>$sub]);
    }

    public function store(Request $request)
    {
        return $request;
    }
}
