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
        <div class="container sm:mx-auto flex flex-wrap px-5 md:flex-row items-center justify-between py-5">
            <div class="text-xl">
                ITスクール浜松
            </div>    
            <nav class="flex flex-wrap items-center text-base">
            @if (Route::has('login'))
                <div class="gap-x-4 flex">
                    @auth
                        <a href="{{ route('tasks.index') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none">
                            ユーザー
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none">
                            ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-500 text-white hover:bg-yellow-600 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                初回登録</a>
                        @endif
                    @endauth
                </div>
            @endif
            </nav>
        </div>
        
    </header>
    <main class="h-screen">
        <div class="bg-blue-200 h-full">
            @include('components/partials/weather')    
        </div>
    </main>
</body>

</html>
