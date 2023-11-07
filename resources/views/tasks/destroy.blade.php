@extends('layouts/layout')

@section('content')
    <div class="">
        <div class="">
            <nav>
                <div class="">タスクを削除する
                </div>
                <div class="">
                    <form action="{{route('tasks.destroy',['id' => $id, 'task_id' => $task_id])}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="task_id" value="{{ $task_id }}">
                        <div class="">
                            {{ $task_id }}
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