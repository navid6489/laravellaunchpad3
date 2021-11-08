<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\student;
use App\Http\Controllers\teachercontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/dashboard', function (Request $request) {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
//register new user
Route::post('/registernewuser',[AuthenticatedSessionController::class,'registernewuser'] )->middleware(['auth'])->name('registernewuser');

//student
Route::post('/studedit/{id?}',[student::class,'studeditentry'])->middleware('auth') ->name('studedit');
Route::post('/studapprove/{id?}',[student::class,'studentapprove'])->middleware('auth') ->name('studapprove');
Route::post('/studdelete/{id?}',[student::class,'studentdelete'])->middleware('auth') ->name('studdelete');
//teacher
Route::post('/teacherapprove/{id?}',[teachercontroller::class,'teacherapprove'])->middleware('auth') ->name('teacherapprove');
Route::post('/teacherdelete/{id?}',[teachercontroller::class,'teacherdeleteachereditte'])->middleware('auth') ->name('teacherdelete');
Route::post('/teacheredit/{id?}',[teachercontroller::class,'teachereditentry'])->middleware('auth') ->name('teacheredit');
//admin
Route::get('/adminstudedit/{id?}',[admincontroller::class,'adminstudeditindex'])->middleware('auth') ->name('adminstudedit');
Route::post('/adminstudedit/{id?}',[admincontroller::class,'adminstudedit'])->middleware('auth') ->name('adminstudeditpost');
Route::get('/adminteacheredit/{id?}',[admincontroller::class,'adminteachereditindex'])->middleware('auth') ->name('adminteacheredit');
Route::post('/adminteacheredit/{id?}',[admincontroller::class,'adminteacheredit'])->middleware('auth') ->name('adminteachereditpost');

