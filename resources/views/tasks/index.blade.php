@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Мои задачи</h1>

        <!-- Кнопка для создания новой задачи -->
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Создать задачу</a>

        <!-- Список невыполненных задач -->
        <div class="list-group mb-4">
            <h2>Невыполненные задачи</h2>
            @foreach ($tasks as $task)
                <div class="list-group-item bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button class="btn btn-success btn-sm mr-2" onclick="toggleTaskCompletion({{ $task->id }}, true)">
                                <i class="fa fa-check"></i>
                            </button>
                            <label class="{{ $task->completed ? 'text-decoration-line-through' : '' }}">
                                <a href="#" class="text-white" onclick="toggleDescription({{ $task->id }})">{{ $task->title }}</a>
                            </label>
                        </div>
                        <div>
                            <small class="text-white">Создано: {{ $task->created_at->format('d.m.Y H:i') }}</small>

                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm mr-2">Редактировать</a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ml-2">Удалить</button>
                            </form>
                        </div>
                    </div>
                    <!-- Описание задачи -->
                    <div id="description_{{ $task->id }}" class="task-description" style="display: none;">
                        {{ $task->description }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Список выполненных задач -->
        <div class="list-group">
            <h2>Выполненные задачи</h2>
            @foreach ($completedTasks as $task)
                <div class="list-group-item bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button class="btn btn-danger btn-sm mr-2" onclick="toggleTaskCompletion({{ $task->id }}, false)">
                                <i class="fa fa-times"></i>
                            </button>
                            <label class="text-decoration-line-through">
                                <a href="#" class="text-white" onclick="toggleDescription({{ $task->id }})">{{ $task->title }}</a>
                            </label>
                        </div>
                        <div>
                            <small class="text-white">Создано: {{ $task->created_at->format('d.m.Y H:i') }}</small>
                            <small class="text-white">Выполнено: {{ $task->completed_at ? \Carbon\Carbon::parse($task->completed_at)->format('d.m.Y H:i') : '-' }}</small>

                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm mr-2">Редактировать</a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm ml-2">Удалить</button>
                            </form>
                        </div>
                    </div>
                    <!-- Описание задачи -->
                    <div id="description_{{ $task->id }}" class="task-description" style="display: none;">
                        {{ $task->description }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Скрипт для обновления состояния выполнения задачи -->
    <script>
        function toggleTaskCompletion(taskId, completed) {
            fetch("{{ url('tasks') }}/" + taskId + "/toggle", {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ completed: completed })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                location.reload();
            })
            .catch(error => {
                console.error('There was an error!', error);
            });
        }

        function toggleDescription(taskId) {
            var description = document.getElementById('description_' + taskId);
            if (description.style.display === 'none') {
                description.style.display = 'block';
            } else {
                description.style.display = 'none';
            }
        }
    </script>
@endsection
