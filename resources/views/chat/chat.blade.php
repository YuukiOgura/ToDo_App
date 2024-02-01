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
  <nav class="max-w-[85rem] mx-auto px-4 sm:px-6 flex justify-between border-t border-gray-200">
    <div class="relative flex flex-row justify-between items-center gap-x-8 py-4 sm:py-0 dark:border-slate-700">
      <div class="flex items-center w-full sm:w-[auto]">
        <span
          class="font-semibold whitespace-nowrap text-gray-800 border-e border-e-white/[.7] sm:border-transparent pe-4 me-4 sm:py-3.5 dark:text-white">
          Chat</span>
      </div>
    </div>
    <div>
      @include('components/partials/sidebar_sumaho')
    </div>
  </nav>

  <main>
    <div class="flex flex-col max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
      <div class="-m-1.5 overflow-x-auto">
        <div class="flex border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
          {{-- サイドバー --}}
          <div>
            @include('components/partials/sidebar')
          </div>

          <div class="content ms-3 me-3 flex-grow lg:max-h-[400px] max-h-[300px]">
            @foreach ($otherUsers as $other)
              <div id="vertical-tab-with-border-{{ $other->id }}" class="hidden" role="tabpanel"
                aria-labelledby="vertical-tab-with-border-item-{{ $other->id }}">

                <div id="message-display-{{ $other->id }}"
                  class="message-display lg:max-h-[400px] max-h-[300px] overflow-auto">
                  @foreach ($allMessages as $message)
                    @if (
                        ($message->user_id == $user_id && $message->recipients->contains('user_id', $other->id)) ||
                            ($message->user_id == $other->id && $message->recipients->contains('user_id', $user_id)))
                      @if ($message->user_id == $user_id)
                        <div class="flex justify-start w-full">
                          <div
                            class="mt-1 mb-1 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-100 text-blue-800">
                            <p>{{ $message->message }}</p>
                          </div>
                        </div>
                      @else
                        <div class="flex justify-end w-full">
                          <div
                            class="mt-1 mb-1 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-teal-100 text-teal-800">
                            <p>{{ $message->message }}</p>
                          </div>
                        </div>
                      @endif
                    @endif
                  @endforeach
                </div>

                <!-- 送信フォーム -->
                <div class="fixed bottom-0 left-0 right-0 bg-white p-4 max-w-[85rem] mx-auto px-4">
                  <form method="post" action="{{ route('chat.send') }}"
                    onsubmit="onsubmit_Form(event, {{ $other->id }});" class="">
                    @csrf
                    <button type="submit" class="text-white bg-blue-700 px-5 py-2">送信</button>
                    <textarea id="input_message_{{ $other->id }}" name="message" autocomplete="off" class="w-full lg:h-20 py-2"></textarea>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
  </main>

  <script>
    // メッセージ送信後に自動で下までスクロールする関数
    function scrollToBottom(elementId) {
      var element = document.getElementById(elementId);
      element.scrollTop = element.scrollHeight;
    }

    // メッセージ送信フォームが送信された時に呼ばれる関数
    function onsubmit_Form(event, otherId) {
      event.preventDefault();
      var messageInput = document.getElementById('input_message_' + otherId);
      var message = messageInput.value;
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      var messageDisplayId = 'message-display-' + otherId;

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

          // 要素を作成
          var containerDiv = document.createElement('div');
          containerDiv.classList.add('flex', 'justify-start', 'w-full');

          var innerDiv = document.createElement('div');
          innerDiv.classList.add('mt-1', 'mb-1', 'py-3', 'px-4', 'inline-flex', 'items-center', 'gap-x-2', 'text-sm',
            'font-semibold', 'rounded-lg', 'border', 'border-transparent', 'bg-blue-100', 'text-blue-800');

          var paragraph = document.createElement('p');
          paragraph.textContent = message; // メッセージを設定

          // 要素を組み合わせ
          innerDiv.appendChild(paragraph);
          containerDiv.appendChild(innerDiv);

          var messageDisplay = document.getElementById(messageDisplayId);
          messageDisplay.appendChild(containerDiv);

          // メッセージ送信後に自動で下までスクロール
          scrollToBottom(messageDisplayId);
        })
        .catch(error => {
          console.error(error);
        });

      messageInput.value = '';
    }
    
    window.addEventListener("DOMContentLoaded", () => {
      @foreach ($otherUsers as $other)
        const messageDisplay_{{ $other->id }} = document.getElementById("message-display-{{ $other->id }}");
      @endforeach
      window.Echo.private('ToDo_Portfolio.{{ Auth::id() }}')
        .listen('MessageSent', (e) => {
          console.log(e);

          @foreach ($otherUsers as $other)
            if (e.message.sender_id === {{ $other->id }}) {
              var containerDiv = document.createElement('div');
              containerDiv.classList.add('flex', 'justify-end', 'w-full');

              var innerDiv = document.createElement('div');
              innerDiv.classList.add('mt-1', 'mb-1', 'py-3', 'px-4', 'inline-flex', 'items-center', 'gap-x-2',
                'text-sm',
                'font-semibold', 'rounded-lg', 'border', 'border-transparent', 'bg-teal-100', 'text-teal-800');
              var paragraph = document.createElement('p');
              paragraph.textContent = e.message.body;

              innerDiv.appendChild(paragraph);
              containerDiv.appendChild(innerDiv);

              messageDisplay_{{ $other->id }}.appendChild(containerDiv);
              scrollToBottom("message-display-{{ $other->id }}");
            }
          @endforeach
        });
    });
  </script>

</body>

</html>
