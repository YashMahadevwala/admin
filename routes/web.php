<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\semesterController;
use App\Http\Controllers\subjectController;
use App\Http\Controllers\lactureController;
use App\Http\Controllers\setpasswordController;
use App\Http\Controllers\testController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['middleware' => ['loginCheck']], function(){
    
    Route::group(['prefix' => 'admin'], function () {
        Route::post('registration',[adminController::class,'store'])->name('admin.register');
        Route::post('login',[adminController::class,'loginCheck'])->name('admin.logincheck');
        Route::get('registration',[adminController::class,'register'])->name('admin.registration');
        Route::get('login',[adminController::class,'login'])->name('admin.login');
        Route::get('dashboard',[adminController::class,'dashboard'])->name('admin.dashboard');
        Route::get('logout',[adminController::class,'logout'])->name('admin.logout');

    // user form
    Route::group(['prefix' => 'users'], function () {
        Route::get('list',[userController::class,'userlist'])->name('admin.users.list');
        Route::get('add',[userController::class,'adduser'])->name('admin.users.add');
        Route::post('add',[userController::class,'storeuser'])->name('admin.users.store');
        Route::get('edit/{id}',[userController::class,'edituser'])->name('admin.users.edit');
        Route::post('update',[userController::class,'updateuser'])->name('admin.users.update');
        Route::get('delete/{id}',[userController::class,'deleteuser'])->name('admin.users.delete');
    });

    // semester
    Route::group(['prefix' => 'semesters'], function () {
        Route::get('list',[semesterController::class,'semesterlist'])->name('admin.semesters.list');
        Route::get('add',[semesterController::class,'addsemester'])->name('admin.semesters.add');
        Route::post('add',[semesterController::class,'storesemester'])->name('admin.semesters.store');
        Route::get('edit/{id}',[semesterController::class,'editsemester'])->name('admin.semesters.edit');
        Route::post('update',[semesterController::class,'updatesemester'])->name('admin.semesters.update');
        Route::get('delete/{id}',[semesterController::class,'deletesemester'])->name('admin.semesters.delete');
    });
    // subjects
    Route::group(['prefix' => 'subjects'], function () {
        Route::get('list',[subjectController::class,'subjectlist'])->name('admin.subjects.list');
        Route::get('add',[subjectController::class,'addsubject'])->name('admin.subjects.add');
        Route::post('add',[subjectController::class,'storesubject'])->name('admin.subjects.store');
        Route::get('edit/{id}',[subjectController::class,'editsubject'])->name('admin.subjects.edit');
        Route::post('update',[subjectController::class,'updatesubject'])->name('admin.subjects.update');
        Route::get('delete/{id}',[subjectController::class,'deletesubject'])->name('admin.subjects.delete');
    });
    // Lacture
    Route::group(['prefix' => 'lactures'], function () {
        Route::get('list',[lactureController::class,'lacturelist'])->name('admin.lactures.list');
        Route::get('add',[lactureController::class,'addlacture'])->name('admin.lactures.add');
        Route::post('add',[lactureController::class,'storelacture'])->name('admin.lactures.store');
        Route::get('edit/{id}',[lactureController::class,'editlacture'])->name('admin.lactures.edit');
        Route::post('update',[lactureController::class,'updatelacture'])->name('admin.lactures.update');
        Route::get('delete/{id}',[lactureController::class,'deletelacture'])->name('admin.lactures.delete');
    });
    
});
});
// 
Route::get('setpassword/set/{id}',[setpasswordController::class,'setpassword'])->name('setpassword.set');
Route::post('setpassword/setpassword',[setpasswordController::class,'setuppassword'])->name('setpassword.setpassword');

// test
Route::get('encode',[setpasswordController::class,'testencode']);

Route::get('toastr',[testController::class,'toastr']);
