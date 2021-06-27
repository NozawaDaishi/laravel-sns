@extends('app')

@section('title', 'タスクの追加')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    @include('nav')
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card mt-5">
                        <button class="text-muted text-center font-weight-bold list-group-item list-group-item-action bg-light">
                            タスクを追加する
                        </button>
                        <div class="card-body">
                            @include('error_card_list')
                            <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">タイトル</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                                </div>
                                <div class="form-group">
                                    <label for="due_date">期限</label>
                                    <input type="date" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
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
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
    <script>
    flatpickr(document.getElementById('due_date'), {
        locale: 'ja',
        dateFormat: "Y/m/d",
        minDate: new Date()
    });
    </script>
@endsection
