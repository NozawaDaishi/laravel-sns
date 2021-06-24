@extends('app')

@section('title', 'ToDo')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
            <div id="modal-delete-{{ $current_folder_id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            @foreach($folders as $folder)
                                @if($current_folder_id === $folder->id)
                                    {{ $folder->title }}を削除します。よろしいですか？
                                @endif
                            @endforeach
                        </div>
                        <div class="modal-footer justify-content-between">
                        <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                        <button type="submit" class="btn btn-danger">削除する</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="list-group card mt-5">
                    <div class="text-muted text-center list-group-item list-group-item-action bg-light d-flex justify-content-between">
                        フォルダー
                        <div class="">
                            <div class="dropup">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" style="z-index: 99;">
                                    <a class="dropdown-item" href="">
                                        <i class="fas fa-pen mr-1"></i>選択中のフォルダー名を編集する
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $current_folder_id }}">
                                        <i class="fas fa-trash-alt mr-1"></i>選択中のフォルダーを削除する
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($folders as $folder)
                        <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" class="list-group-item list-group-item-action {{ $current_folder_id === $folder->id ? 'active' : '' }} text-center">
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
                                            <h6><span class="badge {{ $task->status_class }}">{{ $task->status_label }}</span></h6>
                                        </td>
                                        <td>
                                            {{ $task->due_date }}
                                        </td>
                                        <td>
                                            {{ $task->important_label }}
                                        </td>
                                        <td>
                                            {{ $task->urgent_label }}
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
