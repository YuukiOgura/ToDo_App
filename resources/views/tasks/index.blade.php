<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>ToDo</title>
</head>

<body style ="overflow-y: scroll">

  <!-- Header -->
  @include('components/partials/header')

  <!-- Nav -->
  <nav class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative flex flex-row justify-between items-center gap-x-8 border-t py-4 sm:py-0 dark:border-slate-700">
      <div class="flex items-center w-full sm:w-[auto]">
        <span
          class="font-semibold whitespace-nowrap text-gray-800 border-e border-e-white/[.7] sm:border-transparent pe-4 me-4 sm:py-3.5 dark:text-white">
          ToDo</span>
      </div>
    </div>
  </nav>

  <main>

    <div class="flex flex-col max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pb-5">
      <div class="-m-1.5 overflow-x-auto">
        <div class="">
          <div class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">

            <div class="py-3 px-4 flex justify-between">

              <div class="flex">
                {{-- フォルダー追加モーダル --}}
                <div class="">
                  @include('components/todos/folder_create_modal')
                </div>

                {{-- フォルダー削除モーダル --}}
                @if ($folderFirst)
                  <div class="ml-4">
                    @include('components/todos/folder_delete_modal')
                  </div>
                @endif
              </div>

            </div>

            {{-- ページネーション --}}
            <div class="py-1 px-2">
              <nav class="flex items-center justify-between" aria-label="Tabs" role="tablist">

                <nav
                  class="pb-1 flex space-x-1 w-64 overflow-x-scroll [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500"
                  aria-label="Tabs" role="tablist">
                  {{-- 
                  下記のforeachは、TailwindCSSの記述を使って疑似的なSPAを作るためのページネーションの記述です。
                  --}}
                  @foreach ($folders as $folder)
                    <button type=button
                      class="focus:text-blue-600 min-w-[80px] flex text-gray-800 hover:bg-blue-200 py-2 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 justify-center items-center active
                      flex space-x-1 w-64 overflow-x-scroll
                      [&::-webkit-scrollbar]:h-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500"
                      aria-current="page" id="horizontal-scroll-tab-item-{{ $folder->id }}"
                      data-hs-tab="#horizontal-scroll-tab-{{ $folder->id }}"
                      aria-controls="horizontal-scroll-tab-{{ $folder->id }}" role="tab"
                      style="max-width: 80px; overflow-x: scroll; white-space: nowrap;">
                        {{ $folder->title }}
                    </button>
                  @endforeach
                </nav>

                {{-- タスクの作成モーダル --}}           
                  <div class="flex ml-2">
                    @if ($folderFirst)
                     <div class="flex">
                       @include('components/todos/task_create_modal')
                     </div>
                    @endif
                    {{-- タスクの削除モーダル --}}
                    @if ($grandchildren->count() > 0)
                      <div class="ml-2">
                        @include('components/todos/task_delete_modal')
                      </div>
                    @endif
                  </div>
              </nav>
            </div>

            {{-- テーブル --}}
            <div class="overflow-y-auto max-h-screen">
              {{--
                下記のforeachは、上部のページネーションの記載を用いて連動するテーブル作成に必要な記述です。 
              --}}
              @foreach ($folders as $folder)
                <div id="horizontal-scroll-tab-{{ $folder->id }}" role="tabpanel"
                  aria-labelledby="horizontal-scroll-tab-item-{{ $folder->id }}"
                  {{ $folder->id >= 2 ? 'class=hidden' : '' }}>

                  <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                      <thead class="">
                        <tr class = "">
                          <td class="w-1/4 px-3 py-3 text-xs font-medium text-gray-500 uppercase text-center">タイトル</td>
                          <td class="w-1/4 px-3 py-3 text-xs font-medium text-gray-500 uppercase text-center">期限</td>
                          <td class="w-1/4 px-3 py-3 text-xs font-medium text-gray-500 uppercase text-center">完了</td>
                          <td class="w-1/4 px-3 py-3 text-xs font-medium text-gray-500 uppercase text-center">アクション</td>
                        </tr>
                      </thead>

                      <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                        @foreach ($prioritys as $priority)
                          <tr class="">
                            <td class="px-3 py-1 text-sm font-medium text-gray-500 uppercase text-center">
                              
                                {{ $priority }}
                              
                            </td>
                          </tr>
                          {{-- 
                          下記のforeachは、親foldersと子tasksの外部制約キーが同値かつ、
                          カラム値が同値の場合に表示する様に記載しています。
                          これにより、[重要、普通、後回し]毎に表示分けしています。 
                          --}}
                          @foreach ($tasks as $task)
                            @if ($folder->id == $task->folder_id && $task->priority === $priority && $task->del_flug === 0)
                              <tr>

                                <td class="w-1/4  py-1 text-xs font-medium text-gray-500 uppercase text-center">
                                  @include('components/todos/task_show_modal')
                                </td>

                                <td class="w-1/4  py-1 text-s font-medium text-gray-500 uppercase text-center">
                                  {{ $task->due_date }}
                                </td>

                                <td class="w-1/4  py-1 text-xs font-medium text-gray-500 uppercase text-center">
                                  @if ($task->del_flug === 0)
                                    <form action="{{ route('tasks.complete') }}" method="post">
                                      @csrf
                                      <button type="submit" name='del_flug' value="{{ $task->id }}"
                                        class = "py-1 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-yellow-300 text-white hover:bg-yellow-400 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                        完了
                                      </button>
                                    </form>
                                  @endif
                                </td>

                                <td class="w-1/4  py-1 text-xs font-medium text-gray-500 uppercase text-center">
                                  @if ($task->del_flug === 0)
                                    @include('components/todos/task_edit_modal')
                                  @endif
                                </td>

                              </tr>
                            @endif
                          @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
