<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- Laravelの通信ではcsrf_tokenが必要な為記述 --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Chattest</title>
  {{-- jsの処理 --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  @include('components/partials/header')

  <!-- Nav -->
  <nav class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative flex flex-row justify-between items-center gap-x-8 border-t py-4 sm:py-0 dark:border-slate-700">
      <div class="flex items-center w-full sm:w-[auto]">
        <span
          class="font-semibold whitespace-nowrap text-gray-800 border-e border-e-white/[.7] sm:border-transparent pe-4 me-4 sm:py-3.5 dark:text-white">
          Chat</span>
      </div>
    </div>
  </nav>
  <main>
    <div class="flex flex-col max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="flex border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
            {{-- サイドバー --}}

            <div class="">
              @include('components/partials/sidebar')
            </div>

            <div class="w-full">
              <div class="h-96 overflow-y-auto w-full">
                <div class="" id ="content">
                  ここに変化内容
                </div>
                <ul id = "list_message">
                </ul>
              </div>
              <div class="bottom-0 bg-gray-500">
                <form method ="post" action ="{{ route('chat.send') }}" onsubmit="onsubmit_Form(); return false;">
                  @csrf
                  メッセージ:<input type =" text" id ="input_message" autocomplete="off">
                  <button type ="submit">送信</button>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    // ユーザーごとのページ切り替え処理。
    function loadContent(url) {
      var xhr = new XMLHttpRequest();

      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            // 成功時の処理
            // ControllerからJSONデータを受け取る。
            var responseData = JSON.parse(xhr.responseText);
            //HTMLとして、データを出力する。
            document.getElementById('content').innerHTML = responseData.data;
          } else {
            // エラー時の処理
            alert('エラーです');
          }
        }
      };

      // Ajaxリクエストを実行
      xhr.open('GET', url, true);
      xhr.send();
    }

    // 非同期で、コントローラーに値を渡す処理。
    const elementInputMessage = document.getElementById("input_message");
    let recipientId = null;

    // ユーザーのリンクをクリックしたときの処理。
    document.querySelectorAll('.user-link').forEach(link => {
      link.addEventListener('click', function(event) {
        recipientId = this.getAttribute('data-id')
      });
    });

    /* formのsubmitの処理 */
    function onsubmit_Form() {
      /* 送信用HTMLからInput要素の取得 */
      let strMessage = elementInputMessage.value;
      if (!strMessage || !recipientId) {
        return;
      }
      params = {
        'recipientId': recipientId,
        'message': strMessage
      };

      /* Postリクエスト送信処理とレスポンスの取得処理 */
      axios
        .post('/chat/send', params)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error.response);
        })
      /* テキストHTML要素の中身をクリア */
      elementInputMessage.value = "";
      recipientId = null;
    }

    /* ページ読み込み後の処理 */
    window.addEventListener("DOMContentLoaded", () => {
      const elementListMessage = document.getElementById("list_message");
      window.Echo.private( /* `ToDo_Portfolio.${recipientId}` */ 'ToDo_Portfolio.{{ Auth::id() }}')
        .listen('MessageSent', (e) => {
          console.log(e);
          /* メッセージの整形 */
          let strUsername = e.message.username;
          let strMessage = e.message.body;

          appendMessageList(strUsername, strMessage);

          /* メッセージをメッセージリストに追加 */
          function appendMessageList(username, message) {

            let elementLi = document.createElement("li");
            let elementUsername = document.createElement("strong");
            let elementMessage = document.createElement("div");

            elementUsername.textContent = username;
            elementMessage.textContent = message;
            elementLi.append(elementUsername);
            elementLi.append(elementMessage);
            elementListMessage.appendChild(elementLi);
          }
        })
    })
  </script>

</body>

</html>
