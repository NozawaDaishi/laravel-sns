@extends('app')

@section('title', 'タスクの編集')

@section('styles')
    @include('share.styles')
@endsection

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-5">
                    <div class="text-muted text-center font-weight-bold list-group-item list-group-item-action bg-light">
                        タスクを編集する
                    </div>
                    <div class="card-body">
                        @include('error_card_list')
                        <form action="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title') ?? $task->title }}" />
                            </div>
                            <div class="form-group">
                                <label for="status">状態</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach(\App\Task::STATUS as $key => $val)
                                        <option
                                            value="{{ $key }}"
                                            {{ $key == old('status', $task->status) ? 'selected' : '' }}
                                        >
                                        {{ $val['badge'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="due_date">期限</label>
                                <input type="text" class="form-control" name="due_date" id="due_date"
                                    value="{{ old('due_date') ?? $task->formatted_due_date }}" />
                            </div>
                            <div class="form-group">
                                <label for="important">重要度</label>
                                <select name="important" id="important" class="form-control">
                                    @foreach(\App\Task::IMPORTANT as $key => $val)
                                        <option
                                            value="{{ $key }}"
                                            {{ $key == old('important', $task->important) ? 'selected' : '' }}
                                        >
                                        {{ $val['badge'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="urgent">緊急度</label>
                                <select name="urgent" id="urgent" class="form-control">
                                    @foreach(\App\Task::URGENT as $key => $val)
                                        <option
                                            value="{{ $key }}"
                                            {{ $key == old('urgent', $task->urgent) ? 'selected' : '' }}
                                        >
                                        {{ $val['badge'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">変更</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('share.scripts')
@endsection
