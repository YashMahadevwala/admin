<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    public $table = 'students';

    public function getsubjects()
    {
        return $this->hasMany('App\Models\students_subjects', 'student_id','id');
    }


}
