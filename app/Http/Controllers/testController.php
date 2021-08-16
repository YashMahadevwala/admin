<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class testController extends Controller
{
    public function relationship()
    {
        $stud = student::get();
        dd($stud);
    }
}
