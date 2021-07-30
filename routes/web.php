<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// registration
Route::get('registration',[adminController::class,'register']);
Route::post('registration',[adminController::class,'store']);

// login
Route::get('login',[adminController::class,'login']);
Route::post('login',[adminController::class,'loginCheck']);
Route::get('logout',function(){
    session()->forget('fullname');
    return "done";
});

// dashboard
Route::get('dashboard',[adminController::class,'dashboard']);
// Route::get('dashboard',[adminController::class,'dashboard']);

// user form
Route::get('userlist',[adminController::class,'userlist']);