@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Мои задачи</h2>
        <ul class="list-group">
            @foreach($tasks as $task)
                <li class="list-group-item">
                    <div class="task-item" data-task-id="{{ $task->id }}">
                        <span class="task-title">{{ $task->title }}</span>
                        <button class="btn btn-link task-expand" data-task-id="{{ $task->id }}">
                            <i class="fas fa-chevron-down"></i> Развернуть
                        </button>
                        <button class="btn btn-link task-delete" data-task-id="{{ $task->id }}">
                            <i class="fas fa-trash-alt"></i> Удалить
                        </button>
                        <div class="task-details" style="display: none;">{{ $task->description }}</div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.addEventListener('click', function(event) {
        // Проверяем, был ли клик по кнопке развернуть
        if (event.target.classList.contains('task-expand')) {
            var taskItem = event.target.closest('.task-item');
            var details = taskItem.querySelector('.task-details');
            details.classList.toggle('d-none'); // Bootstrap класс для скрытия элемента
        }

        // Проверяем, был ли клик по кнопке удалить
        if (event.target.classList.contains('task-delete')) {
            var taskId = event.target.getAttribute('data-task-id');
            if (confirm('Вы уверены, что хотите удалить эту задачу?')) {
                fetch('/tasks/' + taskId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    }
                }).catch(error => {
                    console.error('Ошибка удаления задачи:', error);
                });
            }
        }
    });
});
    </script>
@endsection
