<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class UserTaskController extends Controller
{
    // Отображение списка задач
    public function index()
    {
        // Получаем текущего пользователя
        $user = auth()->user();
    
        // Получаем задачи, связанные с текущим пользователем
        $tasks = $user->tasks()->where('completed', false)->get();
        $completedTasks = $user->tasks()->where('completed', true)->get();
    
        return view('tasks.index', compact('tasks', 'completedTasks'));
    }
    

    // Отображение формы создания задачи
    public function create()
    {
        return view('tasks.create');
    }

    // Сохранение новой задачи
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
    
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->completed = false;
        $task->user_id = auth()->id(); // Присваиваем user_id текущего аутентифицированного пользователя
        $task->save();
    
        return redirect()->route('tasks.index');
    }

    // Отображение формы редактирования задачи
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Обновление задачи
    public function update(Request $request, Task $task)
    {
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();

        return redirect()->route('tasks.index');
    }

    // Удаление задачи
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    // Переключение состояния выполнения задачи
    public function toggle(Task $task)
    {
        $task->completed = !$task->completed;
        if ($task->completed) {
            $task->completed_at = now();
        } else {
            $task->completed_at = null;
        }
        $task->save();
    
        return response()->json(['success' => true]);
    }
}

