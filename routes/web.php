<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Маршрут для страницы входа
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');

// Маршрут для обработки входа пользователя
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');

// Маршрут для страницы регистрации
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');

// Маршрут для обработки регистрации пользователя
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

// Маршрут для выхода пользователя
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
