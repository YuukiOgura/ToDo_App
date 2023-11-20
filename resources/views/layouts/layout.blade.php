<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    @yield('content')
  </main>
  @yield('scripts')
  
</body>

</html>
<!--
レイアウトファイルはレイアウトを共有させたいものを記載する
共有しない物は'yield()'で穴埋めをする。
-->
