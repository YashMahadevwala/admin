<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\semesterController;
use App\Http\Controllers\userController;

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
Route::post('registration',[adminController::class,'store']);

// login
Route::post('login',[adminController::class,'loginCheck']);

// logout
Route::get('logout',[adminController::class,'logout']);

// user form
// Route::get('userlist',[adminController::class,'userlist']);
// adduser
// Route::get('adduser',[adminController::class,'adduser']);
// Route::post('adduser',[adminController::class,'storeuser']);

// middleware 
Route::group(['middleware' => ['loginCheck']], function(){
    Route::get('registration',[adminController::class,'register']);
    Route::get('login',[adminController::class,'login']);
    Route::get('dashboard',[adminController::class,'dashboard']);

    // user form
Route::get('userlist',[userController::class,'userlist']);
Route::get('adduser',[userController::class,'adduser']);
Route::post('adduser',[userController::class,'storeuser']);
Route::get('edituser/{id}',[userController::class,'edituser']);
Route::post('updateuser',[userController::class,'updateuser']);
Route::get('deleteuser/{id}',[userController::class,'deleteuser']);

// semester
Route::get('semesterlist',[semesterController::class,'semesterlist']);
Route::get('addsemester',[semesterController::class,'addsemester']);
Route::post('addsemester',[semesterController::class,'storesemester']);
Route::get('editsemester/{id}',[semesterController::class,'editsemester']);
Route::post('updatesemester',[semesterController::class,'updatesemester']);
Route::get('deletesemester/{id}',[semesterController::class,'deletesemester']);
});