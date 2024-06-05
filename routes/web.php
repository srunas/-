<?php

use App\Http\Controllers\UserTaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();


Route::get('/', function () {
    return redirect('/home');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

Route::get('/home', [UserTaskController::class, 'index'])->name('home')->middleware('auth');

Route::patch('tasks/{task}/toggle', [UserTaskController::class, 'toggle'])->name('tasks.toggle');
Route::resource('tasks', UserTaskController::class);