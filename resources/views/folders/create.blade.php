@extends('app')

@section('title', 'フォルダの作成')

@section('content')
@include('nav')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card card-default mt-5">
                <div class="text-muted text-center font-weight-bold list-group-item list-group-item-action bg-light">
                    フォルダを追加する
                </div>
                <div class="card-body">
                <form action="{{ route('folders.create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">フォルダ名</label>
                        <input type="text" class="form-control" name="title" id="title" />
                        </div>
                        <div class="text-right">
                        <button type="submit" class="btn btn-primary">作成</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('content')
