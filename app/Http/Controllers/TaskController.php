<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Другие методы контроллера...

    public function create()
    {
        return view('tasks.create');
    }
    public function store(Request $request)
    {
        // Валидация данных формы
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Другие правила валидации по необходимости
        ]);

        // Создание новой задачи
        $task = new Task();
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        // Другие атрибуты задачи по необходимости
        $task->save();

        // Перенаправление пользователя после успешного создания задачи
        return redirect()->route('tasks.index')->with('success', 'Задача успешно добавлена!');
    }
}