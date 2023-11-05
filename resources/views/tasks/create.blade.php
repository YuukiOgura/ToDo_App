@extends('layouts/layout')

@section('content')
    <div class="">
        <div class="">
            <nav>
                <div class="">タスクを追加する</div>
                <div class="">
                    <form action="{{ route('tasks.create', $id) }}" method="post">
                        <!--
                                        routeはweb.phpの記載をURLの形に変化できるメソッドです。つまりは = コントローラーに情報を渡している。
                                        さらにはmethodを"post"に変更する事で情報の漏洩対策。
                                        下記のcsrfもクロスサイトスクリプティングに対応している。
                                    -->
                        @csrf

                        <!--
                                目的はTaskControllerでfolderidを選択できるようにする。
                                create.blade.phpでフォルダの選択をする1
                            -->
                        <div class="">
                            <select name="folders_select" method = "post">
                                @foreach ($folders as $folder)
                                    <option value = "{{ $folder->id }}">{{ $folder ->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label for="title_task">タスク名</label> <br><!--forとidで紐づけ-->
                            <input type="text" name="title_task" id="title_task"><!--nameは送信された時のキー名-->
                        </div>
                        <div class="">
                            <label for="textarea">タスク説明文</label> <br>
                            <textarea name = "textarea" rows = "3" cols = "50" id = "textarea"></textarea>
                        </div>
                        <div class="">
                            <label for="due_date">期限</label> <br>
                            <input type="text" name="due_date" id = "due_date">
                        </div>
                        <div class="">
                            <label for="priority">重要度を選択してください</label> <br>
                            <input type="radio" name ="priority" value = "1" id = "priority">重要 <br>
                            <input type="radio" name ="priority" value = "2" id = "priority">普通 <br>
                            <input type="radio" name ="priority" value = "3" id = "priority">後回し <br>
                        </div>
                        <div class="">
                            ここにリストを追加して表示する
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
