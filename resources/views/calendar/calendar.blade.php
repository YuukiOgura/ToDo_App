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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'ja',
        height: 'auto',
        firstDay: 1,
        headerToolbar: {
          left: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
          center: "title",
          right: "today prev,next"
        },
        buttonText: {
          today: '今日',
          week: '週',
          day: '日',
          month: '月',
          list: 'リスト'
        },
        allDayText: '終日',

        eventMouseEnter: function(info) {
          // マウスがイベントに入ったときの処理
          document.body.style.cursor = 'pointer'; // カーソルを変更
        },
        eventMouseLeave: function(info) {
          // マウスがイベントから出たときの処理
          document.body.style.cursor = 'default'; // カーソルを元に戻す
        },
        eventDidMount: (e)=>{
          // Tippyプラグインを使用し、クリック時にツールチップを出すようにした。
          tippy(e.el,{
            content: e.event.extendedProps.description,
            trigger:'click',
          });
        },
        events: "/get_events",
      });
      calendar.render();
    });
  </script>
  <style>
    .fc-day-sat {
      background-color: #cce3f6;
    }

    .fc-day-sun {
      background-color: #f4d0df;
    }

    .fc-col-header-cell-cushion,
    .fc-daygrid-day-number,
    .fc-daygrid-day-top {
      color: #333;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  @include('components/partials/header')
  <nav class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative flex flex-row justify-between items-center gap-x-8 border-t py-4 sm:py-0 dark:border-slate-700">
      <div class="flex items-center w-full sm:w-[auto]">
        <span
          class="font-semibold whitespace-nowrap text-gray-800 border-e border-e-white/[.7] sm:border-transparent pe-4 me-4 sm:py-3.5 dark:text-white">
          Calendar</span>

        <div class="w-full sm:hidden">
          <button type="button"
            class="hs-collapse-toggle group w-full inline-flex justify-between items-center gap-2 rounded-lg font-medium text-gray-600 border border-gray-200 align-middle py-1.5 px-2 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-white/[.5] transition"
            data-hs-collapse="#secondary-nav-toggle" aria-controls="secondary-nav-toggle"
            aria-label="Toggle navigation">
            Overview
            <svg class="hs-dropdown-open:rotate-180 flex-shrink-0 w-4 h-4 transition group-hover:text-gray-800"
              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <div class="flex flex-col max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">

            <div class="m-auto m-5 p-5">
              <div id='calendar'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

</body>

</html>
