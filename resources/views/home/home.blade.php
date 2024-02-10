<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topページ</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="text-gray-600 body-font bg-blue-100">
        <div class="container sm:mx-auto flex flex-wrap p-5 md:flex-row items-center justify-between">
            <div class="">
                ITスクール浜松
            </div>
            <nav class="flex flex-wrap items-center text-base">
            @if (Route::has('login'))
                <div class="gap-x-4 flex">
                    @auth
                        <a href="{{ route('tasks.index') }}" class=" hover:text-gray-900">ユーザー</a>
                    @else
                        <a href="{{ route('login') }}" class=" hover:text-gray-900">
                            ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hover:text-gray-900">初回登録</a>
                        @endif
                    @endauth
                </div>
            @endif
            </nav>
        </div>
    </header>
    <main class="h-screen">
        <div class="bg-blue-200 h-full">
            <a href = "{{ route('weather')}}">天気</a>
        </div>
    </main>
</body>

</html>
