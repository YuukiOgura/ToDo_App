<div class="mx-2 max-w-sm border rounded-lg border-gray-800 bg-sky-200 py-2">
  <div id="docs-sidebar" class="">
    <div class="flex gap-x-2 sm:px-10 px-5">
      <div class="flex-none text-xl font-semibold flex items-center" href="#" aria-label="Brand">天気
        {{ $cityName }}
      </div>
      <div class="">
        <form action = "{{ route('weather') }}" method = 'POST' class ="flex items-center gap-x-2">
          @csrf
          <select name="city" id="city" class ="h-8 text-sm py-1 rounded-full focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
            <option value="Hamamatsu">浜松</option>
            @foreach($prefectures as $kanjiPrefecture => $prefecture)
            <option value="{{ $prefecture }}">{{$kanjiPrefecture}}</option>
            @endforeach
          </select>
          <button type ="subimit" class=" rounded-full border border-gray-400 bg-green-400 text-white h-8 p-2 inline-flex items-center">選択</button>
        </form>
      </div>
    </div>
    <nav class="hs-accordion-group w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
      <ul class="space-y-1.5">
        <li class="hs-accordion flex flex-wrap justify-center" id="account-accordion">
          <button type="button"
            class="hs-accordion-toggle hs-accordion-active:text-white hs-accordion-active:hover:bg-sky-600 hs-accordion-active:bg-sky-700 w-80 text-start flex items-center 
            gap-x-3.5 py-1 px-2.5 mt-2 text-sm text-white bg-sky-600 rounded-lg shadow-lg hover:bg-sky-700 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:hs-accordion-active:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">

            {{ $startDay }} ～ {{ $endDay }}
            <svg
              class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-white group-hover:text-gray-500 dark:text-gray-400"
              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m18 15-6-6-6 6" />
            </svg>

            <svg
              class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-white group-hover:text-gray-500 dark:text-gray-400"
              width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            </svg>
          </button>

          <div id="account-accordion"
            class="hs-accordion-content overflow-hidden transition-[height] duration-300 hidden">
            <div class="flex flex-wrap">
              <div class="w-full flex justify-center">
                <nav class="flex mt-1" aria-label="Tabs" role="tablist" data-hs-tabs-vertical="true">
                  @foreach ($formatWeekDays as $formatWeekDay)
                    <button type ="button"
                      class="py-1 px-2 border-b border-gray-400 bg-blue-200 inline-flex justify-center items-center gap-x-2 text-sm 
                      text-gray-500 shadow-lg hover:text-blue-800 focus:outline-none focus:text-blue-600 focus:bg-sky-400 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active"
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
                  <table class="border-collapse rounded-lg overflow-hidden mt-1">
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