<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::group(['middleware'=>'guest'], function(){
    Route::view('/','login');
});
Route::get('/login',[App\Http\Controllers\Auth\LoginController::class,'showLogin'])->name('login');
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

Route::group(['middleware'=>'admin'], function() {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/register', [App\Http\Controllers\AdminController::class, 'register'])->name('register');
    Route::post('/register', [App\Http\Controllers\AdminController::class, 'registerNewUser'])->name('register');
    Route::get('/addcourse', [App\Http\Controllers\AdminController::class, 'addcourse'])->name('addcourse');
    Route::post('/addNewCourse', [App\Http\Controllers\AdminController::class, 'addNewCourse'])->name('addNewCourse');
    Route::get('/coursesList', [App\Http\Controllers\AdminController::class, 'coursesList'])->name('coursesList');
    Route::get('/editCourse/{id}', [App\Http\Controllers\AdminController::class, 'editCourse'])->name('editCourse');
    Route::get('/deleteCourse/{id}', [App\Http\Controllers\AdminController::class, 'deleteCourse'])->name('deleteCourse');
    Route::post('/editCourseData/{id}', [App\Http\Controllers\AdminController::class, 'editCourseData'])->name('editCourseData');
    Route::get('/userList', [App\Http\Controllers\AdminController::class, 'userList'])->name('userList');
    Route::get('/editUser/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('editUser');
    Route::post('/editUserData/{id}', [App\Http\Controllers\AdminController::class, 'editUserData'])->name('editUserData');
    Route::get('/deleteUser/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('deleteUser');
});
Route::group(['middleware'=>'instruktur'], function() {
    Route::get('/instruktur', [App\Http\Controllers\InstrukturController::class, 'index'])->name('instruktur');  
    Route::get('/courseLinked', [App\Http\Controllers\InstrukturController::class, 'course'])->name('courseLinked'); 
    Route::get('/detailCourse/{id}', [App\Http\Controllers\InstrukturController::class, 'detailCourse'])->name('detailCourse');    
    Route::get('/addAssignment/{id}', [App\Http\Controllers\InstrukturController::class, 'addAssignment'])->name('addAssignment');
    Route::post('/addAssignmentData/{id}', [App\Http\Controllers\InstrukturController::class, 'addAssignmentData'])->name('addAssignmentData');    
    Route::get('/detailAssignment/{courseID}/{assignmentID}', [App\Http\Controllers\InstrukturController::class, 'detailAssignment'])->name('detailAssignment');
    Route::get('/gradeAssignment/{assignmentLogID}/{grade}', [App\Http\Controllers\InstrukturController::class, 'gradeAssignment'])->name('gradeAssignment');
});
Route::group(['middleware'=>'member'], function() {
    Route::get('/member', [App\Http\Controllers\MemberController::class, 'index'])->name('member');
    Route::get('/leaderboards', [App\Http\Controllers\MemberController::class, 'leaderboards'])->name('leaderboards');
    Route::get('/enrollCourse', [App\Http\Controllers\MemberController::class, 'enrollCourse'])->name('enrollCourse');
    Route::get('/enroll/{courseID}/{memberID}', [App\Http\Controllers\MemberController::class, 'enroll'])->name('enroll');
    Route::get('/courseList', [App\Http\Controllers\MemberController::class, 'courseList'])->name('courseList');
    Route::get('/courseDetail/{courseID}/{memberID}', [App\Http\Controllers\MemberController::class, 'courseDetail'])->name('courseDetail');
    Route::post('/addSubmission/{courseID}/{assignmentID}/{memberID}', [App\Http\Controllers\MemberController::class, 'addSubmission'])->name('addSubmission');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
