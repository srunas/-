@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Информация о задаче</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $task->title }}</h5>
                <p class="card-text">{{ $task->description }}</p>
                <p class="card-text"><small class="text-muted">Дата создания: {{ $task->created_at }}</small></p>
            </div>
        </div>
    </div>
@endsection