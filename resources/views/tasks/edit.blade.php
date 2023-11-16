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
    <div class="">
      <div class="">
        <section class="text-gray-600 body-font relative">
          <div class="container px-5 py-12 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
              <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                タスク編集
              </h1>
              <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                タスク作成のページになります。
              </p>

              <form action="{{ route('tasks.edit', [$id, $task_id]) }}" method="post">

                @csrf
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                  <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label for="title_edit" class="leading-7 text-sm text-gray-600">
                          タスク名
                        </label> <br><!--forとidで紐づけ-->
                        <input type="text" name="title_edit" id="title_edit" value={{ $tasks->title }}
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        <!--nameは送信された時のキー名-->
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label for="textarea_edit" class="leading-7 text-sm text-gray-600">タスク説明文</label> <br>
                        <textarea name="textarea_edit" id="textarea_edit" cols="50" rows="3"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $tasks->textarea }}</textarea><br>
                        {{-- タスクの説明 --}}
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label for="due_date_edit" class="leading-7 text-sm text-gray-600">
                          期限
                        </label> <br>
                        <input type="text" name="due_date_edit" id="due_date_edit" value={{ $tasks->due_date }}
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>

                      <div class="p-2 w-full">
                        <div class="relative">
                          <label for="priority_edit" class="leading-7 text-sm text-gray-600">重要度を選択してください</label> <br>
                          <div
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">

                            <input type="radio" name ="priority_edit" value = "1"
                              {{ $tasks->priority == 1 ? 'checked' : '' }} id = "priority_edit1" class="mr-2">
                            <label for="priority_edit1" class="mr-4">重要</label>

                            <input type="radio" name ="priority_edit" value = "2"
                              {{ $tasks->priority == 2 ? 'checked' : '' }} id = "priority_edit2" class="mx-4">
                            <label for="priority_edit2" class="mr-4">普通</label>

                            <input type="radio" name ="priority_edit" value = "3"
                              {{ $tasks->priority == 3 ? 'checked' : '' }} id = "priority_edit3" class="ml-2">
                            <label for="priority_edit3">後回し</label>

                            {{-- 重要度 --}}
                          </div>

                          <div class="p-2 w-full">
                            <div class="relative">
                              <button type='submit'
                                class="flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">
                                送信
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
              </form>


            </div>
          </div>
  </main>

  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('due_date_edit'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date()
    });
  </script>
</body>

</html>
