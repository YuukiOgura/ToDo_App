<button type="button"
  class="hidden sm:inline-block py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-orange-300 text-white hover:bg-orange-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
  data-hs-overlay="#hs-task-delete-modal">
  タスクを削除/復元
</button>

<button type="button"
  class="sm:hidden py-2 px-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-orange-300 text-white hover:bg-orange-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
  data-hs-overlay="#hs-task-delete-modal">
  <img src="{{ asset('storage/icon/kago.png') }}" class ="h-8 w-12">
</button>

<div id="hs-task-delete-modal"
  class="hs-overlay hidden w-full h-full fixed top-0 start-0 z-[60] overflow-x-hidden overflow-y-auto pointer-events-none">
  <div
    class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
    <div
      class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
      <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
        <h3 class="font-bold text-gray-800 dark:text-white">
          タスクを削除
        </h3>
        <button type="button"
          class="flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
          data-hs-overlay="#hs-task-delete-modal">
          <span class="sr-only">Close</span>
          <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
        </button>
      </div>


      <form action ="{{ route('tasks.destroy', [$id]) }}" method = 'post'>
        @csrf
        @method('delete')
        <div class="p-4 overflow-y-auto">
          <p class="mt-1 mb-3 text-gray-800 dark:text-gray-400">
            タスクを削除又は復元します。
          </p>
          <div class="flex gap-x-2">
            <div class="flex items-center">
              <input type="radio" name="action" value="delete" id= "delete" required>
              <label for="delete"
                class="flex flex-col w-full max-w-lg mx-auto text-center border-2 rounded-2xl border-red-300 p-2 ml-1 text-2xl text-white bg-red-300">削除</label>
            </div>
            <div class="flex items-center">
              <input type="radio" name="action" value="update" id= "update" required>
              <label for="update"
                class="flex flex-col w-full max-w-lg mx-auto text-center border-2 rounded-2xl border-blue-300 p-2 ml-1 text-2xl text-white bg-blue-300">復元</label>
            </div>
          </div>

          <div class="lg:w-full md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2 mb-10">
              <div class="p-2 w-full">
                <div class="relative">
                  <p class="leading-7 text-sm text-gray-600">タスク名</p>
                  <div
                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 
                            focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none 
                            text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out text-left overflow-x-auto">
                    @foreach ($grandchildren as $children)
                      <div class="flex items-center mb-2">
                        <input type="checkbox" name="check_task[]" value="{{ $children->id }}" class="mr-2">
                        <div
                          class="flex gap-x-2 overflow-x-scroll [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
                          <p class="border-r border-gray-400 pr-2 whitespace-nowrap">{{ $children->title }}</p>
                          <p class="border-r border-gray-400 pr-2 whitespace-nowrap">{{ $children->due_date }}</p>
                          <p class="border-r border-gray-400 pr-2 whitespace-nowrap">{{ $children->priority }}</p>
                          <p class="whitespace-nowrap">{{ $children->textarea }}</p>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-gray-700">
          <button type="button"
            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
            data-hs-overlay="#hs-task-delete-modal">
            戻る
          </button>

          <button type="submit"
            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg 
            border border-gray-200 bg-green-300 text-gray-800 shadow-sm 
            hover:bg-green-400 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 
            dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 
            dark:focus:ring-gray-600">
            処理
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
