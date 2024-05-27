<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

Route::post('/tasks', 'TaskController@store')->name('task.store');

// Страница создания новой задачи
Route::get('/tasks/create', function () {
    return view('tasks.create');
});

Route::get('/tasks/create', 'TaskController@create')->name('tasks.create');

// Страница редактирования существующей задачи
Route::get('/tasks/{id}/edit', function ($id) {
    // Здесь вы можете передать id задачи в вид и использовать его, например, для получения информации о задаче из базы данных
    return view('tasks.edit', ['id' => $id]);
});

// Страница просмотра информации о задаче
Route::get('/tasks/{id}', function ($id) {
    // Здесь также можно использовать id для получения информации о задаче из базы данных
    return view('tasks.show', ['id' => $id]);
});

// Маршруты для обработки форм (например, сохранение новой задачи, обновление существующей, удаление и т. д.)
// Здесь они будут добавлены позже в соответствии с функциональностью вашего приложения
