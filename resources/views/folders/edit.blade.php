@extends('app')

@section('title', 'フォルダ名の編集')

@section('content')
    @include('nav')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-5">
                    <div class="text-muted text-center font-weight-bold list-group-item list-group-item-action bg-light">
                        フォルダ名を編集する
                    </div>
                    <div class="card-body">
                        @include('error_card_list')
                        <form action="{{ route('folders.edit', ['id' => $folder->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title') ?? $folder->title }}" />
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
