<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザーページ</title>
</head>

<body>
    <a href="{{route('profile.edit')}}">
        {{ $name }}
    </a>

    <div class="">
        <a href="{{route('tasks.index',['id' => $id])}}">ToDo作成</a>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <a href="route('logout')"
            onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </a>
    </form>
</body>

</html>
