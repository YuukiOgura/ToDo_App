<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link>
</head>

<body>
  <header class="text-gray-600 body-font bg-blue-100">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <div class="">
        <a href="/top">Topページ</a>
      </div>
    </div>
  </header>
  <main>
    <div class="flex">
      <div id="docs-sidebar"
        class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden  {{-- fixed --}} top-0 start-0 bottom-0  z-[60] w-1/5 bg-white border-e border-gray-200 pt-7 pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500 dark:bg-gray-800 dark:border-gray-700">

        <div class="px-6">
          <p class="flex-none text-xl font-semibold dark:text-white" href="" aria-label="Brand">メニュー</p>
        </div>

        <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
          <ul class="space-y-1.5">
            <li>
              <a class="flex items-center gap-x-3.5 py-2 px-2.5 bg-gray-100 text-sm text-slate-700 rounded-lg hover:bg-gray-100 dark:bg-gray-900 dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                href="{{ route('tasks.index', ['id' => $id]) }}">

                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
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
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
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
                {{ $user->name }}
              </a>
          </ul>
        </nav>
      </div>

      <div class="w-2/5">
        ここにカレンダーを追加する予定
      </div>
      <div class="w-2/5 pt-7 px-6 bg-gray-50 mx-auto text-center">
        {{-- <div class="">フォルダ</div> --}}
        <div class="flex">
          <h3
            class="first:mr-2 w-1/2 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100  hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-blue-900 dark:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
            <a href="{{ route('folders.create') }}" class="text-blue-800">フォルダを追加</a>
            <a href="{{ route('folders.destroy')}}" class ="text-red-800">フォルダを削除</a>
          </h3>
          {{-- <div class="">タスク</div> --}}
          <h3
            class="last:ml-2 w-1/2 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-blue-900 dark:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
            <a href="{{ route('tasks.create', ['id' => $user]) }}">タスクを追加</a>
          </h3>
        </div>
        <nav
          class="pb-1 flex space-x-1 overflow-x-auto [&::-webkit-scrollbar]:h-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500"
          aria-label="Tabs" role="tablist">
          @foreach ($folders as $folder)
            <button type="button"
              class="{{-- hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 --}} py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-blue-500 active"
              id="horizontal-scroll-tab-item-{{ $folder->id }}"
              data-hs-tab="#horizontal-scroll-tab-{{ $folder->id }}"
              aria-controls="horizontal-scroll-tab-{{ $folder->id }}" role="tab">
              {{ $folder->title }}
            </button>
          @endforeach
        </nav>
        <div class="flex flex-col">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 w-full inline-block align-middle">
              @foreach ($folders as $folder)
                <div id="horizontal-scroll-tab-{{ $folder->id }}" role="tabpanel"
                  aria-labelledby="horizontal-scroll-tab-item-{{ $folder->id }}"
                  {{ $folder->id >= 2 ? 'class=hidden' : '' }}>
                  <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                      <thead class="fixed-width-thead">
                        <tr>
                          <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">タイトル</th>
                          <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">期限</th>
                          <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">完了</th>
                          <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">アクション</th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ([1 => '重要', 2 => '普通', 3 => '後回し'] as $priority => $label)
                          <tr>
                            <td colspan="4"
                              class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                              {{ $label }}
                            </td>
                          </tr>
                          @foreach ($tasks as $task)
                            @if ($folder->id == $task->folder_id && $task->priority === $priority)
                              <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                  <a href="{{ route('tasks.show', [$task->id]) }}">{{ $task->title }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                  {{ $task->due_date }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                  @if ($task->del_flug === 0)
                                    <form action="{{ route('tasks.complete', ['id' => $id, 'task_id' => $task->id]) }}"
                                      method="post">
                                      @csrf
                                      <button type="submit" name='del_flug' value="{{ $task->id }}">完了</button>
                                    </form>
                                  @else
                                    <div class="">完了しました</div>
                                  @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 dark:text-gray-200">
                                  @if ($task->del_flug === 0)
                                    <a href="{{ route('tasks.edit', ['id' => $id, 'task_id' => $task->id]) }}">編集</a>
                                  @elseif ($task->del_flug === 1)
                                    <a href="{{ route('tasks.destroy', ['id' => $id, 'task_id' => $task->id]) }}">タスクを削除</a>
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
    </div>
  </main>

</body>
{{-- <div class="mt-3">
      @foreach ($folders as $folder)
        <div id="horizontal-scroll-tab-{{ $folder->id }}" role="tabpanel"
          aria-labelledby="horizontal-scroll-tab-item-{{ $folder->id }}"
          @if ($folder->id >= 2) class="hidden" @endif>
          @foreach ($tasks as $task)
            @if ($folder->id == $task->folder_id)
              <table>
                <tr>
                  <td>{{ $task->title }}</td>
                  <td>{{ $task->due_date }}</td>
                  <td>
                    @if ($task->del_flug === 0)
                      <form action="{{ route('tasks.complete', ['id' => $id, 'task_id' => $task->id]) }}"
                        method = "post">
                        @csrf
                        <button type = "submit" name = 'del_flug' value = "{{ $task->id }}">完了</button>
                      </form>
                    @else
                      <div class="">完了しました</div>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('tasks.edit', ['id' => $id, 'task_id' => $task->id]) }}">編集</a>
                    @if ($task->del_flug === 1)
                      <a href="{{ route('tasks.destroy', ['id' => $id, 'task_id' => $task->id]) }}">タスクを削除</a>
                    @endif
                  </td>
                </tr>
              </table>
            @endif
          @endforeach
        </div>
      @endforeach
    </div> --}}

{{-- <div class="">
        <nav>
          <div class="">フォルダ</div>
          <a href="{{ route('folders.create') }}">フォルダを追加</a>
          <div class="">
            @foreach ($folders as $folder)
              <!--Taskコントローラから渡ってきた値　as 仮変数-->

              {{ $folder->title }}<!--$foldersのtitleをforeachでまわして取り出す-->
            @endforeach
          </div>
          <div class="">タスク</div>

          <a href="{{ route('tasks.create', ['id' => $user]) }}">タスクを追加</a>

          <div class="">
            <table>
              @foreach ($tasks as $task)
                <tr>
                  <!--Taskコントローラから渡ってきた値　as 仮変数-->
                  <td>{{ $task->title }}</td><!--$foldersのtitleをforeachでまわして取り出す-->
                  <td>{{ $task->due_date }}</td>
                  {{ $task->id }}
                  <td>
                    @if ($task->del_flug === 0)
                      <form action="{{ route('tasks.complete', ['id' => $id, 'task_id' => $task->id]) }}"
                        method = "post">
                        @csrf
                        <button type = "submit" name = 'del_flug' value = "{{ $task->id }}">完了</button>
                      </form>
                    @else
                      <div class="">完了しました</div>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('tasks.edit', ['id' => $id, 'task_id' => $task->id]) }}">編集</a>
                    @if ($task->del_flug === 1)
                      <a href="{{ route('tasks.destroy', ['id' => $id, 'task_id' => $task->id]) }}">タスクを削除</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </table>
          </div>
        </nav>
      </div> --}}
