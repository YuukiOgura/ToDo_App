@extends('layouts/layout')

@section('content')
    <div class="">
        <div class="">
            <nav>
                <div class=""></div>
                <div class="">フォルダ</div>
                <a href="{{ route('folders.create') }}">フォルダを追加</a>
                <div class="">
                    @foreach ($folders as $folder)
                        <!--Taskコントローラから渡ってきた値　as 仮変数-->

                        {{ $folder->title }}<!--$foldersのtitleをforeachでまわして取り出す-->
                    @endforeach
                </div>
                <div class="">タスク</div>

                <a href="{{ route('tasks.create', ['id' => $user]) }}">タスクを追加</a>

                <div class="">
                    <table>
                        @foreach ($tasks as $task)
                            <tr>
                                <!--Taskコントローラから渡ってきた値　as 仮変数-->
                                <td>{{ $task->title }}</td><!--$foldersのtitleをforeachでまわして取り出す-->
                                <td>{{ $task->due_date }}</td>
                                 {{ $task->id }}
                                <td>
                                    @if($task->del_flug === 0)
                                    <form action="{{ route('tasks.complete', ['id' => $id, 'task_id' => $task->id]) }}" 
                                        method = "post">
                                    @csrf
                                    <button type = "submit"  name = 'del_flug' value = "{{ $task->id }}">完了</button>
                                    </form>
                                    @else
                                    <div class="">完了しました</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('tasks.edit',['id' => $id, 'task_id' => $task->id]) }}">編集</a>
                                    @if($task->del_flug === 1)
                                    <a href="{{ route('tasks.destroy',['id' => $id, 'task_id' => $task->id]) }}">タスクを削除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </nav>
        </div>
    </div>
@endsection
