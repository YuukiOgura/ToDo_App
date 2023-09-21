@extends('layouts/layout')

@section('content')
    <div class="">
        <div class="">
            <nav>
                <div class="">タスクを削除する
                </div>
                <div class="">
                    <form action="{{route('tasks.destroy',['id'=>$task->folder_id,'task_id'=>$task->id])}}" method="post">
                        @csrf
                        <div class="">
                        </div>
                        <div class="">
                            <button type='submit'>削除</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
@endsection