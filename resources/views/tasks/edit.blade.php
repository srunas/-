@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактирование задачи</h1>
        
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ $task->title }}" required>
            </div>
            
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" class="form-control" id="description" rows="3">{{ $task->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
