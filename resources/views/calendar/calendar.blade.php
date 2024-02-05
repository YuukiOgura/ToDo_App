<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>テストカレンダー</title>
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/tippy.js@6"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
  @vite(['resources/css/calendar.css','resources/css/app.css','resources/js/calendar.js','resources/js/app.js'])
</head>

<body>
  @include('components/partials/header')
  <nav class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative flex flex-row justify-between items-center gap-x-8 border-t py-4 sm:py-0 dark:border-slate-700">
      <div class="flex items-center w-full sm:w-[auto]">
        <span
          class="font-semibold whitespace-nowrap text-gray-800 border-e border-e-white/[.7] sm:border-transparent pe-4 me-4 sm:py-3.5 dark:text-white">
          Calendar</span>
      </div>
      <div id="calendarViewSelector">
        <select id="viewSelector">
          <option value="dayGridMonth">月</option>
          <option value="timeGridWeek">週</option>
          <option value="timeGridDay">日</option>
          <option value="listMonth">リスト</option>
        </select>
      </div>
    </div>
  </nav>

  <main>
    <div class="flex flex-col max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">

            <div class="">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>

</html>
