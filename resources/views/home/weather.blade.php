<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather Forecast</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <div class="mx-2 max-w-sm border rounded-lg border-gray-300">
    <div id="docs-sidebar" class="">
      <div class="flex gap-x-2 px-2.5">
        <div class="flex-none text-xl font-semibold flex items-center" href="#" aria-label="Brand">お天気情報
          {{ $cityName }}
        </div>
        <div class="">
          <form action = "{{ route('weather') }}" method = 'POST'>
            @csrf
            <select name="city" id="city" class ="h-8 py-1">
              <option value="Hamamatsu">浜松</option>
              <option value="Shizuoka">静岡</option>
            </select>
            <button type ="subimit">選択</button>
          </form>
        </div>
      </div>
      <nav class="hs-accordion-group w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="space-y-1.5">
          <li class="hs-accordion" id="account-accordion">
            <button type="button"
              class="hs-accordion-toggle hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:hs-accordion-active:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">

              {{ $startDay }} ～ {{ $endDay }}
              <svg
                class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m18 15-6-6-6 6" />
              </svg>

              <svg
                class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
                width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
              </svg>
            </button>

            <div id="account-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden px-2.5">
              <div class="flex flex-wrap">
                <div class="w-full flex justify-center">
                  <nav class="flex" aria-label="Tabs" role="tablist" data-hs-tabs-vertical="true">
                    @foreach ($formatWeekDays as $formatWeekDay)
                      <button type ="button"
                        class="py-1 px-2 border-b border-gray-300 bg-green-200 inline-flex justify-center items-center gap-x-2 text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 focus:bg-green-400 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active"
                        id="vertical-tab-with-border-item-{{ $formatWeekDay }}"
                        data-hs-tab="#vertical-tab-with-border-{{ $formatWeekDay }}"
                        aria-controls="vertical-tab-with-border-{{ $formatWeekDay }}" role="tab">
                        {{ $formatWeekDay }}
                      </button>
                    @endforeach
                  </nav>
                </div>
              </div>
              <div class="content flex-grow w-full flex justify-center">
                @foreach ($formatWeekDays as $formatWeekDay)
                  <div id="vertical-tab-with-border-{{ $formatWeekDay }}" class="hidden" role="tabpanel"
                    aria-labelledby="vertical-tab-with-border-item-{{ $formatWeekDay }}">
                    <table class="border-collapse rounded-lg overflow-hidden mt-4">
                      <thead>
                        <tr class="grid grid-cols-4">
                          @foreach ($weatherData['list'] as $weather)
                            @if (date('m-d', strtotime($weather['dt_txt'])) === $formatWeekDay)
                              @if (date('H', strtotime($weather['dt_txt'])) >= 0 && date('H', strtotime($weather['dt_txt'])) <= 9)
                                <th class="border border-gray-400 px-3 py-2 w-20">
                                  {{ date('H:i', strtotime($weather['dt_txt'])) }}</th>
                              @endif
                            @endif
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="grid grid-cols-4">
                          @foreach ($weatherData['list'] as $weather)
                            @if (date('m-d', strtotime($weather['dt_txt'])) === $formatWeekDay)
                              @if (date('H', strtotime($weather['dt_txt'])) >= 0 && date('H', strtotime($weather['dt_txt'])) <= 9)
                                <td class="border border-gray-400 px-3 py-2 w-20">
                                  {{ $weather['weather'][0]['description'] }}
                                </td>
                              @endif
                            @endif
                          @endforeach
                        </tr>
                        <tr class="grid grid-cols-4">
                          @foreach ($weatherData['list'] as $weather)
                            @if (date('m-d', strtotime($weather['dt_txt'])) === $formatWeekDay)
                              @if (date('H', strtotime($weather['dt_txt'])) >= 0 && date('H', strtotime($weather['dt_txt'])) <= 9)
                                <td class="border border-gray-400 px-3 py-2 w-20">
                                  <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}.png"
                                    alt="Weather Icon">
                                </td>
                              @endif
                            @endif
                          @endforeach
                        </tr>
                        <tr class="grid grid-cols-4">
                          @foreach ($weatherData['list'] as $weather)
                            @if (date('m-d', strtotime($weather['dt_txt'])) === $formatWeekDay)
                              @if (date('H', strtotime($weather['dt_txt'])) >= 0 && date('H', strtotime($weather['dt_txt'])) <= 9)
                                <td class="border border-gray-400 px-3 py-2 w-20">
                                  {{ $weather['main']['temp_max'] }}℃<br />
                                  {{ $weather['main']['temp_min'] }}℃
                                </td>
                              @endif
                            @endif
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                    <table class="border-collapse rounded-lg overflow-hidden">
                      <thead>
                        <tr class="grid grid-cols-4">
                          @foreach ($weatherData['list'] as $weather)
                            @if (date('m-d', strtotime($weather['dt_txt'])) === $formatWeekDay)
                              @if (date('H', strtotime($weather['dt_txt'])) >= 12 && date('H', strtotime($weather['dt_txt'])) <= 24)
                                <th class="border border-gray-400 px-3 py-2 w-20">
                                  {{ date('H:i', strtotime($weather['dt_txt'])) }}</th>
                              @endif
                            @endif
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="grid grid-cols-4">
                          @foreach ($weatherData['list'] as $weather)
                            @if (date('m-d', strtotime($weather['dt_txt'])) === $formatWeekDay)
                              @if (date('H', strtotime($weather['dt_txt'])) >= 12 && date('H', strtotime($weather['dt_txt'])) <= 24)
                                <td class="border border-gray-400 px-3 py-2 w-20">
                                  {{ $weather['weather'][0]['description'] }}
                                </td>
                              @endif
                            @endif
                          @endforeach
                        </tr>
                        <tr class="grid grid-cols-4">
                          @foreach ($weatherData['list'] as $weather)
                            @if (date('m-d', strtotime($weather['dt_txt'])) === $formatWeekDay)
                              @if (date('H', strtotime($weather['dt_txt'])) >= 12 && date('H', strtotime($weather['dt_txt'])) <= 24)
                                <td class="border border-gray-400 px-3 py-2 w-20">
                                  <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}.png"
                                    alt="Weather Icon">
                                </td>
                              @endif
                            @endif
                          @endforeach
                        </tr>
                        <tr class="grid grid-cols-4">
                          @foreach ($weatherData['list'] as $weather)
                            @if (date('m-d', strtotime($weather['dt_txt'])) === $formatWeekDay)
                              @if (date('H', strtotime($weather['dt_txt'])) >= 12 && date('H', strtotime($weather['dt_txt'])) <= 24)
                                <td class="border border-gray-400 px-3 py-2 w-20">
                                  {{ $weather['main']['temp_max'] }}℃<br />
                                  {{ $weather['main']['temp_min'] }}℃
                                </td>
                              @endif
                            @endif
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>
                @endforeach
              </div>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </div>




</body>

</html>
