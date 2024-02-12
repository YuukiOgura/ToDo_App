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