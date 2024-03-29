<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ユーザーページ</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <header class="text-gray-600 body-font bg-blue-100">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <div class="">
        ITスクール浜松
      </div>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">


        <form method="POST" action="{{ route('logout') }}" class="mr-5 hover:text-gray-900">
          @csrf

          <a href="route('logout')"
            onclick="event.preventDefault();
                                this.closest('form').submit();"
            class="">
            {{ __('Log Out') }}
          </a>
        </form>
      </nav>
    </div>
  </header>
  <main>

    {{-- <div class="">
      <a href="{{ route('tasks.index', ['id' => $id]) }}">ToDo作成</a>
    </div> --}}
    <!-- Navigation Toggle -->
    {{-- <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#docs-sidebar"
      aria-controls="docs-sidebar" aria-label="Toggle navigation">
      <span class="sr-only">Toggle Navigation</span>
      <svg class="flex-shrink-0 w-4 h-4" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path fill-rule="evenodd"
          d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
      </svg> 
    </button>--}}
    <!-- End Navigation Toggle -->

    <div id="docs-sidebar"
      class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden  {{-- fixed --}} top-0 start-0 bottom-0  z-[60] w-64 bg-white border-e border-gray-200 pt-7 pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500 dark:bg-gray-800 dark:border-gray-700">

      <div class="px-6">
        <p class="flex-none text-xl font-semibold dark:text-white" href="" aria-label="Brand">メニュー</p>
      </div>

      <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="space-y-1.5">
          <li>
            <a class="flex items-center gap-x-3.5 py-2 px-2.5 bg-gray-100 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
              href="{{ route('tasks.index', ['id' => $id]) }}">

              <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                  d="M15.5 2H8.6c-.4 0-.8.2-1.1.5-.3.3-.5.7-.5 1.1v12.8c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h9.8c.4 0 .8-.2 1.1-.5.3-.3.5-.7.5-1.1V6.5L15.5 2z" />
                <path d="M3 7.6v12.8c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h9.8" />
                <path d="M15 2v5h5" />
              </svg>
              ToDo作成
            </a>
          </li>

          <li class="hs-accordion" id="account-accordion">
            <a class="flex items-center gap-x-3.5 py-2 px-2.5 bg-gray-100 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
              href="{{ route('profile.edit') }}" class="mr-5 hover:text-gray-900">
              <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="18" cy="15" r="3" />
                <circle cx="9" cy="7" r="4" />
                <path d="M10 15H6a4 4 0 0 0-4 4v2" />
                <path d="m21.7 16.4-.9-.3" />
                <path d="m15.2 13.9-.9-.3" />
                <path d="m16.6 18.7.3-.9" />
                <path d="m19.1 12.2.3-.9" />
                <path d="m19.6 18.7-.4-1" />
                <path d="m16.8 12.3-.4-1" />
                <path d="m14.3 16.6 1-.4" />
                <path d="m20.7 13.8 1-.4" />
              </svg>
              {{ $name }}
            </a>
          </ul>
        </nav>
      </div> 
    </main>
  </body>
  
  </html>
    
    {{-- <div id="account-accordion"
    class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
            <ul class="pt-2 ps-2">
                <li>
                  <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#">
                    Link 1
                  </a>
                </li>
                <li>
                  <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#">
                    Link 2
                  </a>
                </li>
                <li>
                  <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#">
                    Link 3
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="hs-accordion" id="projects-accordion">
            <button type="button"
              class="hs-accordion-toggle hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:hs-accordion-active:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
              <svg class="w-4 h-4" xmlns="ƒhttp://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path
                  d="M15.5 2H8.6c-.4 0-.8.2-1.1.5-.3.3-.5.7-.5 1.1v12.8c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h9.8c.4 0 .8-.2 1.1-.5.3-.3.5-.7.5-1.1V6.5L15.5 2z" />
                <path d="M3 7.6v12.8c0 .4.2.8.5 1.1.3.3.7.5 1.1.5h9.8" />
                <path d="M15 2v5h5" />
              </svg>
              Projects

              <svg
                class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m18 15-6-6-6 6" />
              </svg>

              <svg
                class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
                width="16" height="16" viewBox="0 0 16 16" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
              </svg>
            </button>

            <div id="projects-accordion"
              class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
              <ul class="pt-2 ps-2">
                <li>
                  <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#">
                    Link 1
                  </a>
                </li>
                <li>
                  <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#">
                    Link 2
                  </a>
                </li>
                <li>
                  <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#">
                    Link 3
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li><a
              class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
              href="#">
              <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                <line x1="16" x2="16" y1="2" y2="6" />
                <line x1="8" x2="8" y1="2" y2="6" />
                <line x1="3" x2="21" y1="10" y2="10" />
                <path d="M8 14h.01" />
                <path d="M12 14h.01" />
                <path d="M16 14h.01" />
                <path d="M8 18h.01" />
                <path d="M12 18h.01" />
                <path d="M16 18h.01" />
              </svg>
              Calendar
            </a></li>
          <li><a
              class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
              href="#">
              <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
              </svg>
              Documentation
            </a></li>--}}
  {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Navigation Toggle
      const toggleButton = document.querySelector('[data-hs-overlay="#docs-sidebar"]');
      const sidebar = document.getElementById('docs-sidebar');

      toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('hs-overlay-open:translate-x-0');
        sidebar.classList.toggle('-translate-x-full');
      });

      // Accordion Menu
      const accordionButtons = document.querySelectorAll('.hs-accordion-toggle');

      accordionButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          const content = button.nextElementSibling;
          content.classList.toggle('hidden');

          if (content.classList.contains('hidden')) {
            button.querySelector('.hs-accordion-active:block').classList.add('hidden');
            button.querySelector('.hs-accordion-active:hidden').classList.remove('hidden');
          } else {
            button.querySelector('.hs-accordion-active:hidden').classList.add('hidden');
            button.querySelector('.hs-accordion-active:block').classList.remove('hidden');
          }
        });
      });
    });
  </script> --}}
