<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('view.login');

Route::post('/login', [AuthController::class, 'login'])->name('login');


///auth required routes
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

// /admin only routes

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'admindash'])->name('view.admindash');
    Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
    Route::get('/register', [AuthController::class, 'viewregister'])->name('view.register');

});

////staff only routes
Route::middleware(['auth', 'is_staff'])->group(function () {
    Route::get('/staff/dashboard', [AuthController::class, 'staffdash'])->name('view.staffdash');
    Route::get('/staff/Assigned_tasks', [TaskController::class, 'task_list'])->name('task.list');
    Route::patch('/staff/complete_task/{id}', [TaskController::class, 'complete_task'])->name('task.complete');

});

////manager only routes 
Route::middleware(['auth', 'is_manager'])->group(function () {
    Route::get('/manager/dashboard', [AuthController::class, 'managerdash'])->name('view.managerdash');
    Route::get('/add/task', [TaskController::class, 'view_task'])->name('form.task');
    Route::post('/add/task', [TaskController::class, 'add_task'])->name('add.task');
    Route::get('/view/task', [TaskController::class, 'task_list_manager'])->name('task.list.manager');
    Route::get('/edit/task/{id}', [TaskController::class, 'edit_task_page'])->name('manager.task.edit');
    Route::put('/edit/task/{id}', [TaskController::class, 'edit_task'])->name('manager.task.update');
    

    
});

