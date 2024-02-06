<script>
    @foreach ($otherUsers as $other)
      // クリックされた時の処理
      document.getElementById("scrollButton-{{ $other->id }}").addEventListener("click", function() {
        // スクロール可能な<div>要素を取得
        var scrollableDiv = document.getElementById("message-display-{{ $other->id }}");
        // スクロールバーを一番下にスクロールさせる
        scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
      });
    @endforeach
  
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