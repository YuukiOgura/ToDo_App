<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
  @yield('script')
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <header class="text-gray-600 body-font bg-blue-100">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <div class="">
        <a href="/top">Topページ</a>
      </div>
    </div>
  </header>
  <main>
    @yield('main')
  </main>
  @yield('bottom_script')
</body>

</html>
<!--
レイアウトファイルはレイアウトを共有させたいものを記載する
共有しない物は'yield()'で穴埋めをする。
-->
