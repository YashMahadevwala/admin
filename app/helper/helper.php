<?php

use App\Models\user;
use App\Models\semester;
// use Symfony\Component\HttpFoundation\Request;
// use Illuminate\Http\Request;

function get_name($id){
    
    $data = user::where('id',$id)->select('firstname','lastname')->first();
    return $data->firstname ." ". $data->lastname;
}

function get_sem($id){
    
    $data = semester::where('id',$id)->select('semestername')->first();
    return $data->semestername;
}

if (! function_exists('activeMenu')) {
    function activeMenu($uri = '')
    {
        $active = '';
        if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
            $active = 'active';
        }
        return $active;
    }
}

function success_alert($success){
    return '  <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Data !</strong> ' . $success .'
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
    </div>';
}

function danger_alert($danger){
    return '  <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Data !</strong> ' . $danger .'
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
    </div>';
}


?>