@extends('layouts/layout')

@section('content')
    <div class="">
        <div class="">
            <nav>
                <div class="">フォルダを追加する</div>
                <div class="">
                    <form action="{{ route('folders.create')}}" method="post">
                        <!--
                                routeはweb.phpの記載をURLの形に変化できるメソッドです。=　コントローラーに情報を渡している。
                                さらにはmethodを"post"に変更する事で情報の漏洩対策。
                                下記のcsrfもクロスサイトスクリプティングに対応している。
                            -->
                        @csrf
                        <div class="">
                            <label for="title">フォルダ名</label><!--forとidで紐づけ-->
                            <input type="text" name="title" id="title"><!--nameは送信された時のキー名-->
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
