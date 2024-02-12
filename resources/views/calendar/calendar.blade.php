<!DOCTYPE html>
@extends('layouts.main')
@section('title', 'テストカレンダー')
@push('topScript')
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/tippy.js@6"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
@endpush
@vite(['resources/css/calendar.css', 'resources/css/app.css', 'resources/js/calendar.js', 'resources/js/app.js'])

@section('navTitle','Calendar')
@section('subMenu')
  <div id="calendarViewSelector">
    <select id="viewSelector">
      <option value="dayGridMonth">月</option>
      <option value="timeGridWeek">週</option>
      <option value="timeGridDay">日</option>
      <option value="listMonth">リスト</option>
    </select>
  </div>
@endsection

@section('content')
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
@endsection