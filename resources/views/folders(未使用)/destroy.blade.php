@extends('layouts/todo/layout')
@section('main')
  <section class="text-gray-600 body-font relative">
    <div class="container px-5 py-12 mx-auto">
      <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
          フォルダー削除ページ
        </h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
          フォルダー削除ページになります。<br>
          フォルダーを削除すると、中のタスクもすべて削除されてしまう為、注意してください。
        </p>
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
          <div class="flex flex-wrap -m-2">
            <div class="p-2 w-full">
              <div class="relative">
                <p class="leading-7 text-sm text-gray-600">フォルダ名</p>

                <form action ="{{ route('folders.destroy') }}" method = 'post'>
                  @csrf
                  @method('delete')
                  @foreach ($folders as $folder)
                    <div
                      class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      <input type=checkbox name = "check_folder[]" value = "{{ $folder->id }}">{{ $folder->title }}
                    </div>
                  @endforeach
                  <button type='submit'
                    class="flex mx-auto text-white bg-red-400 border-0 py-2 px-8 focus:outline-none hover:bg-red-500 rounded text-lg">
                    削除</button>
                </form>
                
              </div>
            </div>
            <div class="p-2 w-full">
              <div class="relative">
                <button type='submit'
                  class="flex mx-auto text-white bg-blue-400 border-0 py-2 px-8 focus:outline-none hover:bg-blue-500 rounded text-lg">
                  <a href = "{{ route('tasks.index', $id) }}">
                    戻る
                  </a>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
