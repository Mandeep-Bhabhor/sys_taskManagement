<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;


Route::get('/', function () {
    return view('welcome');
})->name('view.login');

Route::post('/login', [AuthController::class , 'login'])->name('login');


Route::middleware(['auth'])->group (function(){

Route::get('/admin/dashboard', [AuthController::class , 'admindash'])->name('view.admindash');
Route::get('/manager/dashboard', [AuthController::class , 'managerdash'])->name('view.managerdash');
Route::get('/staff/dashboard', [AuthController::class , 'staffdash'])->name('view.staffdash');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

///admin only routes 

Route::middleware(['auth','is_admin'])->group(function(){
Route::post('/register', [AdminController::class , 'register'])->name('admin.register');
Route::get('/register',[AuthController::class , 'viewregister'])->name('view.register');

});