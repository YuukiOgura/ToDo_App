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
    <section class="text-gray-600 body-font relative">
      <div class="container px-5 py-12 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
          <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
            タスク詳細ページ
          </h1>
          <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
            タスクの詳細ページになります。
          </p>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <div class="flex flex-wrap -m-2">
              <div class="p-2 w-full">
                <div class="relative">
									<p class="leading-7 text-sm text-gray-600">タスク名</p>
									<div
                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
										{{ $tasks->title }}
                  </div>           
                  <!--nameは送信された時のキー名-->
                </div>
              </div>
              <div class="p-2 w-full">
                <div class="relative">
									<p class="leading-7 text-sm text-gray-600">タスクの説明</p>
                  <div
                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    {{ $tasks->textarea }}
                  </div>
                </div>
                {{-- タスクの説明 --}}
              </div>
              <div class="p-2 w-full">
                <div class="relative">
									<p class="leading-7 text-sm text-gray-600">期限</p>
                  <div class=" w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
										{{ $tasks->due_date }}
									</div>
                </div>

                <div class="p-2 w-full">
                  <div class="relative">
                    <p class="leading-7 text-sm text-gray-600">重要度</p>
                    <div
                      class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
											@if($tasks->priority === 1)
											重要
											@endif
											@if($tasks->priority === 2)
											普通
											@endif
											@if($tasks->priority === 3)
											後回し
											@endif
                      {{-- 重要度 --}}
                    </div>

                    <div class="p-2 w-full">
                      <div class="relative">
                        <button type='submit'
                          class="flex mx-auto text-white bg-blue-400 border-0 py-2 px-8 focus:outline-none hover:bg-blue-500 rounded text-lg">
                          <a href = "{{route('tasks.index',$id)}}">
														戻る
													</a>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>
</body>
