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
Route::get('userlist',[adminController::class,'userlist']);
// adduser
Route::get('adduser',[adminController::class,'adduser']);
Route::post('adduser',[adminController::class,'storeuser']);
Route::get('edituser/{id}',[adminController::class,'edituser']);
Route::post('updateuser',[adminController::class,'updateuser']);
Route::get('deleteuser/{id}',[adminController::class,'deleteuser']);

// semester
Route::get('semesterlist',[adminController::class,'semesterlist']);
// add semester
Route::get('addsemester',[adminController::class,'addsemester']);
Route::post('addsemester',[adminController::class,'storesemester']);
});