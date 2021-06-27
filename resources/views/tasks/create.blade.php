@extends('app')

@section('title', 'タスクの作成')

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
                        タスクを追加する
                    </div>
                    <div class="card-body">
                        @include('error_card_list')
                        <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="due_date">期限</label>
                                <input type="date" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}"/>
                            </div>
                            <div class="d-flex justify-content-around mt-5">
                                <div class="form-group">
                                    <label class="control-label">
                                        重要度
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="important" id="important1" value="1" checked>
                                        <label class="form-check-label badge badge-pill badge-info" for="important1">
                                        Low
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="important" id="important2" value="2">
                                        <label class="form-check-label badge badge-pill badge-danger" for="important2">
                                        High
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        緊急度
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="urgent" id="urgent1" value="1" checked>
                                        <label class="form-check-label badge badge-pill badge-info" for="urgent1">
                                        Low
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="urgent" id="urgent2" value="2">
                                        <label class="form-check-label badge badge-pill badge-danger" for="urgent2">
                                        High
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-block aqua-gradient mt-5 mb-3">作成</button>
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
