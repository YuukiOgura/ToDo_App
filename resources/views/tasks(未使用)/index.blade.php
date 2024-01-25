@extends('layouts/todo/layout')
@section('script')
@include('layouts/todo/fullcalendar')
@endsection

@section('main')
  <div class="flex">
    @include('layouts/todo/sidebar')

    <div class="w-2/5">
      <div class="" id='calendar'></div>
    </div>

    <div class="w-2/5 pt-7 px-6 bg-gray-50 mx-auto text-center">
      {{-- <div class="">フォルダ</div> --}}
      <div class="flex">
        <h3
          class="first:mr-2 w-1/2 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100  hover:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-blue-900 dark:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
          <a href="{{ route('folders.create') }}" class="text-blue-800">フォルダを追加</a>
          <a href="{{ route('folders.destroy') }}" class ="text-red-800">フォルダを削除</a>
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
            id="horizontal-scroll-tab-item-{{ $folder->id }}" data-hs-tab="#horizontal-scroll-tab-{{ $folder->id }}"
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
                              <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
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
                              <td
                                class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800 dark:text-gray-200">
                                @if ($task->del_flug === 0)
                                  <a href="{{ route('tasks.edit', ['id' => $id, 'task_id' => $task->id]) }}">編集</a>
                                @elseif ($task->del_flug === 1)
                                  <a
                                    href="{{ route('tasks.destroy', ['id' => $id, 'task_id' => $task->id]) }}">タスクを削除</a>
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
@endsection
