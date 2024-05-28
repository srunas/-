<?php
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');