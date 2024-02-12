<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
      },
      locale: "ja",
      events: '/get_events',
    });
    calendar.render();
  });
</script>
{{--　本当は、app.jsで読み込めるようにしたかったが、解決出来ず、一時断念 --}}