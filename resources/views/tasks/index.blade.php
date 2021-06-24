@extends('app')

@section('title', 'ToDo')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
            <div class="col col-md-4">
                {{-- <nav class="navbar navbar-light bg-light mt-5 mb-2">
                    <div class="container-fluid justify-content-center">
                        <span class="navbar-text">
                            フォルダ
                        </span>
                    </div>
                </nav> --}}
                <div class="list-group card mt-5">
                    <div class="text-muted text-center list-group-item list-group-item-action bg-light">
                        フォルダー
                    </div>
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
                <div class="list-group align-items-center ">

                    <div class="card mt-5">
                        <div class="text-muted text-center list-group-item list-group-item-action bg-light">
                            タスク
                        </div>
                        <table class="table text-center list-group-item list-group-item-action ">
                            <thead>
                                <tr>
                                    <th>タイトル</th>
                                    <th>状態</th>
                                    <th>期限</th>
                                    <th>重要度</th>
                                    <th>緊急度</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>
                                            {{ $task->title }}
                                        </td>
                                        <td>
                                            <span class="label">{{ $task->status }}</span>
                                        </td>
                                        <td>
                                            {{ $task->due_date }}
                                        </td>
                                        <td>
                                            {{ $task->important }}
                                        </td>
                                        <td>
                                            {{ $task->important }}
                                        </td>
                                        <td>
                                            <a href="#">編集</a>
                                        </td>
                                        <td>
                                            <a href="#">削除</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="#" class="text-muted text-center list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
