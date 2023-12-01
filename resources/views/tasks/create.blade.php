@extends('layouts/todo/layout')
@section('main')
  <div class="">
    <div class="">
      <section class="text-gray-600 body-font relative">
        <div class="container px-5 py-12 mx-auto">
          <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
              タスク作成
            </h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
              タスク作成のページになります。
            </p>

            <form action="{{ route('tasks.create', $id) }}" method="post">
              @csrf

              <div class="lg:w-1/2 md:w-2/3 mx-auto">
                <div class="flex flex-wrap -m-2">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                  <div class="p-2 w-full">
                    <div class="relative">

                      <label for ="folders_select" class="leading-7 text-sm text-gray-600">
                        フォルダ
                      </label>
                      <select name="folders_select" method = "post" id="folders_select"
                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @foreach ($folders as $folder)
                          <option value = "{{ $folder->id }}">{{ $folder->title }}
                          </option>
                        @endforeach
                      </select>

                    </div>
                  </div>
                  <div class="p-2 w-full">
                    <div class="relative">
                      <label for="title_task" class="leading-7 text-sm text-gray-600">
                        タスク名
                      </label> <br>
                      <input type="text" name="title_task" id="title_task"
                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                  </div>

                  <div class="p-2 w-full">
                    <div class="relative">
                      <label for="textarea" class="leading-7 text-sm text-gray-600">タスク説明文</label> <br>
                      <textarea name = "textarea" rows = "3" cols = "50" id = "textarea"
                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                    </div>
                  </div>
                  <div class="p-2 w-full">
                    <div class="relative">
                      <label for="due_date" class="leading-7 text-sm text-gray-600">
                        期限
                      </label> <br>
                      <input type="text" name="due_date" id = "due_date"
                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                  </div>
                  <div class="p-2 w-full">
                    <div class="relative">
                      <label for="priority" class="leading-7 text-sm text-gray-600">重要度を選択してください</label> <br>
                      <div
                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">

                        <input type="radio" name="priority" value="1" id="priority1" class="mr-2">
                        <label for="priority1" class="mr-4">重要</label>

                        <input type="radio" name="priority" value="2" id="priority2" class="mx-4">
                        <label for="priority2" class="mr-4">普通</label>

                        <input type="radio" name="priority" value="3" id="priority3" class ="ml-2">
                        <label for="priority3">後回し</label>
                      </div>
                    </div>
                    <div class="">
                      ここにリストを追加して表示する
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
      </section>
    </div>
  </div>
@endsection
@section('bottom_script')
  <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
  <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
  <script>
    flatpickr(document.getElementById('due_date'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date()
    });
  </script>
@endsection
