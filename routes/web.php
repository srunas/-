<?php

use App\Http\Controllers\UserTaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Аутентификационные маршруты
Auth::routes();

// Перенаправление на домашнюю страницу
Route::get('/', function () {
    return redirect('/home');
});

// Домашняя страница, доступная только аутентифицированным пользователям
Route::get('/home', [UserTaskController::class, 'index'])->name('home')->middleware('auth');

Route::patch('tasks/{task}/toggle', [UserTaskController::class, 'toggle'])->name('tasks.toggle');
Route::resource('tasks', UserTaskController::class);