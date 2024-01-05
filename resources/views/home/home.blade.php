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
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <div class="">
                ITスクール浜松
            </div>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ route('tasks.index') }}" class="mr-5 hover:text-gray-900">ユーザー</a>
                    @else
                        <a href="{{ route('login') }}" class="mr-5 hover:text-gray-900">
                            ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="mr-5 hover:text-gray-900">初回登録</a>
                        @endif
                    @endauth
                </div>
            @endif
            </nav>
        </div>
    </header>
    <main>
        
    </main>
</body>

</html>
