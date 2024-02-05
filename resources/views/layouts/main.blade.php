<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @yield('meta')
  <title>@yield('title')</title>
  @stack('topScript')
</head>

<body class ="overflow-y-scroll">
  {{-- Header --}}
  @include('components/partials/header')

  {{-- Nav --}}
  <nav class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pb-2">
    <div class="relative flex flex-row justify-between items-center border-t sm:py-0 dark:border-slate-700 pb-2">
      <div class="flex items-center w-full sm:w-[auto]">
        <span
          class="font-semibold whitespace-nowrap text-gray-800 border-e border-e-white/[.7] sm:border-transparent pe-4 me-4 sm:py-3.5 dark:text-white py-2">
          @yield('navTitle')</span>
      </div>
      @yield('subMenu')
    </div>
  </nav>
  <main>
    @yield('content')
  </main>
  @stack('bottomScript')
</body>

</html>
