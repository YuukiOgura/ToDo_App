<!-- ブラウザサイズの場合 -->
<button type="button"
  class="hidden sm:inline-block py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-300 text-white hover:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
  data-hs-overlay="#hs-task_create-modal-{{ $user->id }}">
  タスク作成
</button>

<!-- スマホサイズの場合 -->
<button type="button"
  class="sm:hidden py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-300 text-white hover:bg-blue-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
  data-hs-overlay="#hs-task_create-modal-{{ $user->id }}">
  <img src="{{ asset('storage/icon/hanepen.png') }}" class ="w-8">
</button>

<div id="hs-task_create-modal-{{ $user->id }}"
  class="hs-overlay hidden w-full h-full fixed top-0 start-0 z-[60] overflow-x-hidden overflow-y-auto pointer-events-none">
  <div
    class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
    <div
      class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
      <div class="flex justify-between items-center py-3 px-4 border-b dark:border-gray-700">
        <h3 class="font-bold text-gray-800 dark:text-white">
          タスク作成
        </h3>
        <button type="button"
          class="flex justify-center items-center w-7 h-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-gray-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
          data-hs-overlay="#hs-task_create-modal-{{ $user->id }}">
          <span class="sr-only">Close</span>
          <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
        </button>
      </div>

      <form action="{{ route('tasks.store', [$id]) }}" method="post" onsubmit="return validateFormTask()">
        @csrf
        <div class="p-4 overflow-y-auto">
          <p class="mt-1 mb-10 text-gray-800 dark:text-gray-400">
            タスクを作ります。
          </p>

          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="relative">

              <label for ="folders_select" class="leading-7 text-sm text-gray-600">
                フォルダ
              </label>
              <select name="folders_select" method = "post" id="folders_select" required
                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                @foreach ($folders as $folder)
                  <option value = "{{ $folder->id }}">{{ $folder->title }}
                  </option>
                @endforeach
              </select>
              <div id="folderError" class="alert alert-danger text-red-500" style="display: none;"></div>


            </div>

            <div class="relative">
              <div class="leading-7 text-sm text-gray-600">重要度を選択してください</div>
              <div
                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">

                <input type="radio" name="priority" value="1" id="priority1" class="mr-2" required>
                <label for="priority1" class="mr-4">重要</label>

                <input type="radio" name="priority" value="2" id="priority2" class="mx-4" required>
                <label for="priority2" class="mr-4">普通</label>

                <input type="radio" name="priority" value="3" id="priority3" class ="ml-2" required>
                <label for="priority3">後回し</label>
              </div>
              @error('priority')
                <div class="alert alert-danger text-red-500">{{ $message }}</div>
              @enderror
              <div id="priorityError" class="alert alert-danger text-red-500" style="display: none;"></div>

              <div class="relative">
                <label for="title" class="leading-7 text-sm text-gray-600">
                  タスク名
                </label>

                <input type="text" name="title_task" id="title_task" required
                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">

                @error('title_task')
                  <div class="alert alert-danger text-red-500">{{ $message }}</div>
                @enderror
                <div id="taskTitleError" class="alert alert-danger text-red-500" style="display: none;"></div>
              </div>

              <div class="relative">
                <label for="textarea" class="leading-7 text-sm text-gray-600">タスク説明文</label> <br>
                <textarea name="textarea" id="textarea" cols="50" rows="3" required
                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea><br>
                {{-- タスクの説明 --}}
                @error('textarea')
                  <div class="alert alert-danger text-red-500">{{ $message }}</div>
                @enderror
                <div id="taskTextareaError" class="alert alert-danger text-red-500" style="display: none;"></div>
              </div>

              <div class="relative mb-2">
                <label for="due_date" class="leading-7 text-sm text-gray-600">
                  期限
                </label> <br>
                <input type="date" name="due_date" id = "due_date" required
                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                @error('due_date')
                  <div class="alert alert-danger text-red-500">{{ $message }}</div>
                @enderror
                <div id="dueDateError" class="alert alert-danger text-red-500 mb-2" style="display: none;"></div>
              </div>
            </div>
          </div>

          <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-gray-700">
            <button type="button"
              class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
              data-hs-overlay="#hs-task_create-modal-{{ $user->id }}">
              戻る
            </button>

            <button type="submit"
              class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
              保存
            </button>
          </div>
      </form>
    </div>
  </div>


</div>
