@extends('layouts/layout')

@section('content')
    <div class="">
        まずはフォルダーを作成しよう！！
    </div>
    <div class="">
        <a href = "{{route('folders.create')}}">フォルダー作成</a>
    </div>
@endsection
