@extends('app')

@section('title', 'ToDo')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row mt-5">
                <div id="modal-delete-{{ $current_folder_id }}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('folders.destroy', [$current_folder_id]) }}">
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
                    <div class="text-muted text-center font-weight-bold list-group-item list-group-item-action bg-light d-flex justify-content-between">
                        フォルダ
                        <div class="">
                            <div class="dropup">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" style="z-index: 99;">
                                    <a class="dropdown-item" href="{{ route('folders.edit', ['id' => $current_folder_id]) }}">
                                        <i class="fas fa-pen mr-1"></i>選択中のフォルダ名を編集する
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $current_folder_id }}">
                                        <i class="fas fa-trash-alt mr-1"></i>選択中のフォルダを削除する
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
                    <a href="{{ route('folders.create') }}" class="list-group-item list-group-item-action text-muted text-center">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>
            <div class="col col-md-8">
                <div class="list-group align-items-center">
                    <div class="card mt-5 ">
                        <div class="text-muted text-center font-weight-bold list-group-item list-group-item-action bg-light">
                            タスク
                        </div>
                        @if($tasks->isEmpty())
                            <div class="text-muted text-center font-weight-bold list-group-item list-group-item-action">
                                タスクが登録されていません。
                            </div>
                        @else
                            <table class="table text-center list-group-item list-group-item-action ">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">タイトル</th>
                                        <th class="font-weight-bold">状態</th>
                                        <th class="font-weight-bold">期限</th>
                                        <th class="font-weight-bold">重要度</th>
                                        <th class="font-weight-bold">緊急度</th>
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
                                                <h6><span class="badge {{ $task->status_class }}">{{ $task->status_badge }}</span></h6>
                                            </td>
                                            <td>
                                                {{ $task->formatted_due_date }}
                                            </td>
                                            <td>
                                                <h6><span class="badge {{ $task->important_class }}">{{ $task->important_badge }}</span></h6>
                                            </td>
                                            <td>
                                                <h6><span class="badge {{ $task->urgent_class }}">{{ $task->urgent_badge }}</span></h6>
                                            </td>
                                            <td>
                                                <div class="dropup">
                                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" style="z-index: 99;">
                                                        <a class="dropdown-item" href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">
                                                            <i class="fas fa-pen mr-1"></i>タスクを編集する
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <form method="POST" action="{{ route('tasks.destroy', ['task' => $task]) }}" name="task_delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a class="dropdown-item text-danger" onclick="document.task_delete.submit();"><i class="fas fa-trash-alt mr-1"></i>タスクを削除する</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="text-muted text-center list-group-item list-group-item-action">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-group align-item-center">
            <div class="card m-5">
                <div class="card-title text-center font-weight-bold text-muted bg-light list-group-item list-group-item-action">
                    重要度・緊急度マトリクス
                </div>
                <div class="row mt-1 p-3">
                    <div class="col col-md-3">
                        <div class="list-group-item list-group-item-action text-center bg-danger text-dark">
                                A
                        </div>
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="font-weight-bold">重要度</th>
                                    <th class="font-weight-bold">緊急度</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-pill badge-danger">High</span></td>
                                    <td><span class="badge badge-pill badge-danger">High</span></td>
                                </tr>
                            </tbody>
                        </table>
                        @foreach($tasks as $task)
                            @if($task->important === 2 && $task->urgent === 2)
                                <a href="" class="list-group-item list-group-item-action text-left">
                                    <span class="badge {{ $task->status_class }} mr-2">{{ $task->status_badge }}</span>{{ $task->title }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="col col-md-3">
                        <div class="list-group-item list-group-item-action text-center bg-warning text-dark">
                            B
                        </div>
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="font-weight-bold">重要度</th>
                                    <th class="font-weight-bold">緊急度</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-pill badge-danger">High</span></td>
                                    <td><span class="badge badge-pill badge-info">Low</span></td>
                                </tr>
                            </tbody>
                        </table>
                        @foreach($tasks as $task)
                            @if($task->important === 2 && $task->urgent === 1)
                                <a href="" class="list-group-item list-group-item-action text-left">
                                    <span class="badge {{ $task->status_class }} mr-2">{{ $task->status_badge }}</span>{{ $task->title }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="col col-md-3">
                        <div class="list-group-item list-group-item-action text-center bg-secondary text-dark">
                            C
                        </div>
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="font-weight-bold">重要度</th>
                                    <th class="font-weight-bold">緊急度</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold"><span class="badge badge-pill badge-info">Low</span></td>
                                    <td class="font-weight-bold"><span class="badge badge-pill badge-danger">High</span></td>
                                </tr>
                            </tbody>
                        </table>
                        @foreach($tasks as $task)
                            @if($task->important === 1 && $task->urgent === 2)
                                <a href="" class="list-group-item list-group-item-action text-left">
                                    <span class="badge {{ $task->status_class }} mr-2">{{ $task->status_badge }}</span>{{ $task->title }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="col col-md-3">
                        <div class="list-group-item list-group-item-action text-center bg-info text-dark">
                            D
                        </div>
                        <table class="table table-bordered text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="font-weight-bold">重要度</th>
                                    <th class="font-weight-bold">緊急度</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-pill badge-info">Low</span></td>
                                    <td><span class="badge badge-pill badge-info">Low</span></td>
                                </tr>
                            </tbody>
                        </table>
                        @foreach($tasks as $task)
                            @if($task->important === 1 && $task->urgent === 1)
                                <a href="" class="list-group-item list-group-item-action text-left">
                                    <span class="badge {{ $task->status_class }} mr-2">{{ $task->status_badge }}</span>{{ $task->title }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="text-muted text-center list-group-item list-group-item-action">
                    <i class="fas fa-plus-circle"></i>
                </a>
            </div>
            <div class="list-group align-items-center">
                <div class="card mb-5">
                    <div class="text-muted text-center font-weight-bold list-group-item list-group-item-action bg-light">
                        重要度・緊急度マトリクスの各領域
                    </div>
                    <table class="table table-bordered text-center list-group-item list-group-item-action">
                        <thead>
                        <tr>
                            <th class="text-center bg-danger text-dark">A</th>
                            <th class="text-center bg-warning text-dark">B</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>実行しないと大きな損失が発生するタスク</td>
                            <td>成長に大事な自己投資・啓発のタスク</td>
                        </tr>
                        </tbody>
                        <thead>
                        <tr>
                            <th class="text-center bg-secondary text-dark">C</th>
                            <th class="text-center bg-info text-dark">D</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>他の人の仕事を止めないためのタスク</td>
                            <td>本当はやらなくてもよいタスク</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
