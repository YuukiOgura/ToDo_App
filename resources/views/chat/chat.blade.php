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
                  送信側メッセージ
                  <div id="message-display-{{ $other->id }}" class="message-display"></div>
                  受信側メッセージ
                  <div id="other-display-{{ $other->id }}" class="other-display"></div>
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

    window.addEventListener("DOMContentLoaded", () => {
    @foreach ($otherUsers as $other)
      const messageDisplay_{{ $other->id }} = document.getElementById("other-display-{{ $other->id }}");

      window.Echo.private('ToDo_Portfolio.{{ Auth::id() }}')
        .listen('MessageSent', (e) => {
          console.log(e);

          // Check if the received message is from the correct sender
          if (e.message.sender_id === {{ $other->id }}) {
            var receivedMessage = document.createElement('div');
            receivedMessage.textContent = e.message.body;
            messageDisplay_{{ $other->id }}.appendChild(receivedMessage);
          }
        });
    @endforeach
  });
  </script>

</body>

</html>