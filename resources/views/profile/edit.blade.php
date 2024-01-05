<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>ToDo</title>
</head>

<body style ="overflow-y: scroll">

  <!-- Header -->
  @include('components/partials/header')

  <!-- Nav -->
  <nav class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative flex flex-row justify-between items-center gap-x-8 border-t py-4 sm:py-0 dark:border-slate-700">
      <div class="flex items-center w-full sm:w-[auto]">
        <span
          class="font-semibold whitespace-nowrap text-gray-800 border-e border-e-white/[.7] sm:border-transparent pe-4 me-4 sm:py-3.5 dark:text-white">
          ToDo</span>
      </div>
    </div>
  </nav>
  <main>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
          </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <div class="max-w-xl">
            @include('profile.partials.update-password-form')
          </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
