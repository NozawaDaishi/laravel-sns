@extends('app')

@section('title', 'ユーザー検索')

@section('content')
    @include('nav')
    <div class="container">
        @foreach($users as $person)
            @include('users.person')
        @endforeach
    </div>
@endsection
