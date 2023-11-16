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
          <div class="container px-5 pt-12 pb-5 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
              <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                フォルダ作成
              </h1>
              <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                フォルダ作成のページになります。
              </p>

              <nav>

                <div class="flex flex-col text-center w-full mb-12">
                  <form action="{{ route('folders.create') }}" method="post">
                    <!--
                                routeはweb.phpの記載をURLの形に変化できるメソッドです。=　コントローラーに情報を渡している。
                                さらにはmethodを"post"に変更する事で情報の漏洩対策。
                                下記のcsrfもクロスサイトスクリプティングに対応している。
                            -->
                    @csrf
                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                      <div class="flex flex-wrap -m-2">
                        <label for="title" class="leading-7 text-sm text-gray-600">
                          フォルダ名
                        </label><!--forとidで紐づけ-->
                        <input type="text" name="title" id="title"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        <!--nameは送信された時のキー名-->
                      </div>
                    </div>
                    <div class="p-2 py-10 w-full">
                      <div class="relative">
                        <button type='submit'
                          class="flex mx-auto text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">
                          送信
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </nav>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
</body>

</html>
