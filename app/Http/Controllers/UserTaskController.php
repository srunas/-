<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


class UserTaskController extends Controller
{
    // Другие методы контроллера...

    public function create()
    {
            return view('tasks.create');
    }
    public function show($id)
{
    // Получение задачи по её идентификатору и отображение её
    $task = Task::findOrFail($id);
    return view('tasks.show', ['task' => $task]);
}
    public function index()
    {
            $tasks = Task::all();
            return view('tasks.index', ['tasks' => $tasks]);
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
        return redirect()->route('tasks.index');
    }
    
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Задача успешно удалена'], 200);
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

}