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

                <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}">タスクを追加</a>

                <div class="">
                    <table>
                        @foreach ($tasks as $task)
                            <tr>
                                <!--Taskコントローラから渡ってきた値　as 仮変数-->
                                <td>{{ $task->title }}</td><!--$foldersのtitleをforeachでまわして取り出す-->
                                <td>{{ $task->due_date }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">編集</a>
                                    <a href="{{ route('tasks.destroy', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">タスクを削除</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </nav>
        </div>
    </div>
@endsection
