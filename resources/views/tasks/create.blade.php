@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создание задачи</h1>
        
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
