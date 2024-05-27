@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Редактировать задачу</h2>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Название:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}">
            </div>
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection