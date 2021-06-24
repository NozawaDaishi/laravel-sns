@extends('app')

@section('title', 'ToDo')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
        <div class="col col-md-4">
            <nav class="navbar navbar-light bg-light mt-5 mb-2">
                <div class="container-fluid justify-content-center">
                    <span class="navbar-text">
                        フォルダ
                    </span>
                </div>
            </nav>
            <div class="list-group card">
                @foreach($folders as $folder)
                <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" class="list-group-item list-group-item-action {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                    {{ $folder->title }}
                </a>
                @endforeach
                <a href="#" class="list-group-item list-group-item-action text-muted text-center">
                    <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
        <div class="column col-md-8">
            <!-- ここにタスクが表示される -->
        </div>
        </div>
    </div>

@endsection
