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


            <div class="content ms-3">
              @foreach ($otherUsers as $other)
                <div id="vertical-tab-with-border-{{ $other->id }}" class="hidden" role="tabpanel"
                  aria-labelledby="vertical-tab-with-border-item-{{ $other->id }}">
                  <p class="text-gray-500 dark:text-gray-400">
                    これは<em class="font-semibold text-gray-800 dark:text-gray-200">{{ $other->name }}</em>アイテムのタブボディです。
                  </p>
                  <div id="message-display-{{ $other->id }}" class="message-display"></div>
                  <form method="post" action="{{ route('chat.send') }}"
                    onsubmit="onsubmit_Form(event, {{ $other->id }});">
                    @csrf
                    メッセージ: <input type="text" id="input_message_{{ $other->id }}" autocomplete="off" />
                    <button type="submit" class="text-white bg-blue-700 px-5 py-2">送信</button>
                  </form>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>

  <script>
    // 値の送信と取得
    function onsubmit_Form(event, otherId) {
      event.preventDefault();
      var messageInput = document.getElementById('input_message_' + otherId);
      var message = messageInput.value;
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      var messageDisplay = document.getElementById('message-display-' + otherId);

      // コントローラーに値を送信する。
      axios.post("{{ route('chat.send') }}", {
          message: message,
          other_id: otherId
        }, {
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          }
        })
        .then(response => {
          console.log(response);
          // メッセージを表示する
          var sentMessage = document.createElement('div');
          sentMessage.textContent = message;
          messageDisplay.appendChild(sentMessage);
        })
        .catch(error => {
          console.error(error);
        });

      messageInput.value = '';
    }
    
    // Pusherからの受信
    window.addEventListener("DOMContentLoaded", () => {
      const messageDisplay = document.getElementById("message-display-{{ $other->id }}");
      window.Echo.private('ToDo_Portfolio.{{ Auth::id() }}')
        .listen('MessageSent', (e) => {
          console.log(e);
          var receivedMessage = document.createElement('div');
          receivedMessage.textContent = e.message.body;
          messageDisplay.appendChild(receivedMessage);
        });
    });
  </script>
</body>

</html>


{{--    // ユーザーごとのページ切り替え処理。
    /*  function loadContent(url) {
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
     } */

    // 非同期で、コントローラーに値を渡す処理。
    /* const elementInputMessage = document.getElementById("input_message");
    let recipientId = null; */

    // ユーザーのリンクをクリックしたときの処理。
    /* document.querySelectorAll('.user-link').forEach(link => {
      link.addEventListener('click', function(event) {
        recipientId = this.getAttribute('data-id')
      });
    }); */

    /* formのsubmitの処理 */
    //function onsubmit_Form() {
    /* 送信用HTMLからInput要素の取得 */
    /* let strMessage = elementInputMessage.value;
          if (!strMessage || !recipientId) {
            return;
          }
          params = {
            'recipientId': recipientId,
            'message': strMessage
          };
     */
    /* Postリクエスト送信処理とレスポンスの取得処理 */
    /* axios
      .post('/chat/send', params)
      .then(response => {
        console.log(response);
      })
      .catch(error => {
        console.log(error.response);
      }) */
    /* テキストHTML要素の中身をクリア */
    /*  elementInputMessage.value = "";
          recipientId = null;
        } */

    /* ページ読み込み後の処理 */
    /*  window.addEventListener("DOMContentLoaded", () => {
       const elementListMessage = document.getElementById("list_message");
       window.Echo.private( `ToDo_Portfolio.${recipientId}`'ToDo_Portfolio.{{ Auth::id() }}')
         .listen('MessageSent', (e) => {
           console.log(e); */
    /* メッセージの整形 */
    /* let strUsername = e.message.username;
    let strMessage = e.message.body;

    appendMessageList(strUsername, strMessage); */

    /* メッセージをメッセージリストに追加 */
    /* function appendMessageList(username, message) {

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
      }) */
  
 --}}
