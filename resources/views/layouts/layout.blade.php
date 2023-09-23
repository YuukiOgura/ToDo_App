<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    @yield('styles')
    <link>
</head>

<body>
    <header>
        <nav>
            <a href="/">ToDo App</a>
        </nav>
    </header>
    <main>
        @auth
            @yield('content')
        @endauth
    </main>
    @yield('scripts')
</body>

</html>
<!--
レイアウトファイルはレイアウトを共有させたいものを記載する
共有しない物は'yield()'で穴埋めをする。
-->
