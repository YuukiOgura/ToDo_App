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
          start: 'prev,next today',
          center: 'title',
          right: ''
        },

        dayHeaderContent: function(arg) {
          if (arg.view.type === 'timeGridWeek') {
            // 週間表示の場合のみ日付の部分だけを表示
            return arg.date.getDate().toString();
          } else {
            // 月間表示や日間表示の場合は曜日を表示
            return arg.date.toLocaleDateString('ja-JP', {
              weekday: 'short'
            }); 
          }
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
        eventDidMount: (e) => {
          // Tippyプラグインを使用し、クリック時にツールチップを出すようにした。
          tippy(e.el, {
            content: e.event.extendedProps.description,
            trigger: 'click',
          });
        },
        events: "/get_events",
      });

      // ドロップダウンメニューの変更を監視し、FullCalendarの表示を変更する
      document.getElementById('viewSelector').addEventListener('change', function() {
        var selectedView = this.value;
        calendar.changeView(selectedView);
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

    @media (max-width: 768px) {
      .fc .fc-toolbar-title {
        font-size: 16px !important;
      }
    }

    @media (max-width: 768px) {
      .fc .fc-button {
        margin-left: 0.2em !important;
        padding: 0.4em 0.4em
      }
    }

    @media (max-width:768px) {
      .fc .fc-toolbar.fc-header-toolbar {
        margin-bottom: 0.1em;
      }
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
