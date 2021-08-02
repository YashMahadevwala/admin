<?php

use App\Models\user;
use App\Models\semester;

function get_name($id){
    
    $data = user::where('id',$id)->select('firstname','lastname')->first();
    return $data->firstname ." ".$data->lastname;
}

function get_sem($id){
    
    $data = semester::where('id',$id)->select('semestername')->first();
    return $data->semestername;
}

?>