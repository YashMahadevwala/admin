<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\semesterController;
use App\Http\Controllers\subjectController;
use App\Http\Controllers\lactureController;
use App\Http\Controllers\setpasswordController;
use App\Http\Controllers\testController;
use App\Http\Controllers\ajaxController;
use App\Http\Controllers\studentController;

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
        Route::get('show',[userController::class,'showdata'])->name('admin.users.show');
    });

    // semester
    Route::group(['prefix' => 'semesters'], function () {
        Route::get('list',[semesterController::class,'semesterlist'])->name('admin.semesters.list');
        Route::get('add',[semesterController::class,'addsemester'])->name('admin.semesters.add');
        Route::post('add',[semesterController::class,'storesemester'])->name('admin.semesters.store');
        Route::get('edit/{id}',[semesterController::class,'editsemester'])->name('admin.semesters.edit');
        Route::post('update',[semesterController::class,'updatesemester'])->name('admin.semesters.update');
        Route::get('delete/{id}',[semesterController::class,'deletesemester'])->name('admin.semesters.delete');
        Route::get('show',[semesterController::class,'showdata'])->name('admin.semesters.show');
    });
    // subjects
    Route::group(['prefix' => 'subjects'], function () {
        Route::get('list',[subjectController::class,'subjectlist'])->name('admin.subjects.list');
        Route::get('add',[subjectController::class,'addsubject'])->name('admin.subjects.add');
        Route::post('add',[subjectController::class,'storesubject'])->name('admin.subjects.store');
        Route::get('edit/{id}',[subjectController::class,'editsubject'])->name('admin.subjects.edit');
        Route::post('update',[subjectController::class,'updatesubject'])->name('admin.subjects.update');
        Route::get('delete/{id}',[subjectController::class,'deletesubject'])->name('admin.subjects.delete');
        Route::get('show',[subjectController::class,'showdata'])->name('admin.subjects.show');

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
 
    // students
    Route::group(['prefix' => 'students'], function () {
        Route::get('list',[studentController::class,'studentlist'])->name('admin.students.list');
        Route::get('add',[studentController::class,'addstudent'])->name('admin.students.add');
        Route::post('add',[studentController::class,'storestudent'])->name('admin.students.store');
        Route::get('edit/{id}',[studentController::class,'editstudent'])->name('admin.students.edit');
        Route::post('update',[studentController::class,'updatestudent'])->name('admin.students.update');
        Route::get('delete/{id}',[studentController::class,'deletestudent'])->name('admin.students.delete');
        Route::get('show',[studentController::class,'showdata'])->name('admin.students.show');

    });

    
});
});
// 
Route::get('setpassword/set/{id}',[setpasswordController::class,'setpassword'])->name('setpassword.set');
Route::post('setpassword/setpassword',[setpasswordController::class,'setuppassword'])->name('setpassword.setpassword');

Route::get('encode',[setpasswordController::class,'testencode']);

Route::get('toastr',[testController::class,'toastr']);

Route::get('relation',[testController::class,'relationship']);

Route::post('change_semester_status',[semesterController::class,'change_status']);
Route::post('change_subject_status',[subjectController::class,'change_status']);
