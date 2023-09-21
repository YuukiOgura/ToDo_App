@extends('layouts/layout')

@section('content')
    <div class="">
        <div class="">
            <nav>
                <div class="">タスクを編集する
                </div>
                <div class="">
                    <form action="{{route('tasks.edit',['id'=>$task->folder_id,'task_id'=>$task->id])}}" method="post">
                        <!--
                                routeはweb.phpの記載をURLの形に変化できるメソッドです。つまりは = コントローラーに情報を渡している。
                                さらにはmethodを"post"に変更する事で情報の漏洩対策と、Taskコントローラのeditに渡す。
                                下記のcsrfもクロスサイトスクリプティングに対応している。
                            -->
                        @csrf
                        <div class="">
                            <label for="title_edit">タスク名</label><!--forとidで紐づけ-->
                            <input type="text" name="title_edit" id="title_edit"><!--nameは送信された時のキー名-->
                        </div>
                        <div class="">
                            <label for="due_date_edit">期限</label>
                            <input type="text" name="due_date_edit" id="due_date_edit">
                        </div>
                        <div class="">
                            <button type='submit'>送信</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
@endsection
