<div id="docs-sidebar"
  class="hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden top-0 start-0 bottom-0 z-[60] w-64 bg-white border-e border-gray-200 {{-- pt-7 --}} pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500 dark:bg-gray-800 dark:border-gray-700">
  <div class="">
    <a class="flex-none text-xl font-semibold dark:text-white" href="#" aria-label="Brand">ユーザー名</a>
  </div>
  <nav class="hs-accordion-group w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
    <ul class="space-y-1.5">
      <li class="hs-accordion" id="account-accordion">
        <button type="button"
          class="hs-accordion-toggle hs-accordion-active:text-blue-600 hs-accordion-active:hover:bg-transparent w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-slate-400 dark:hover:text-slate-300 dark:hs-accordion-active:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
          <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
          User

          <svg
            class="hs-accordion-active:block ms-auto hidden w-4 h-4 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m18 15-6-6-6 6" />
          </svg>

          <svg
            class="hs-accordion-active:hidden ms-auto block w-4 h-4 text-gray-600 group-hover:text-gray-500 dark:text-gray-400"
            width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5" stroke="currentColor"
              stroke-width="2" stroke-linecap="round"></path>
          </svg>
        </button>

        <div id="account-accordion"
          class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
          <div class="flex flex-wrap">
            <div class="w-full">
              <nav class="flex flex-col space-y-2" aria-label="Tabs" role="tablist" data-hs-tabs-vertical="true">
                @foreach ($otherUsers as $other)
                  <button type="button"
                    class="py-1 pe-4 border-b border-gray-300 bg-green-200 inline-flex justify-center items-center gap-x-2 text-sm text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 focus:bg-green-400 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active"
                    id="vertical-tab-with-border-item-{{ $other->id }}"
                    data-hs-tab="#vertical-tab-with-border-{{ $other->id }}"
                    aria-controls="vertical-tab-with-border-{{ $other->id }}" role="tab">
                    {{ $other->name }}
                  </button>
                @endforeach
              </nav>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </nav>
</div>
