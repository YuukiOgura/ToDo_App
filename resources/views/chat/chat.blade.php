<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- Laravelの通信ではcsrf_tokenが必要な為記述 --}}
  <meta name ="csrf-token" content={{ csrf_token() }}>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Chattest</title>
  {{-- jsの処理 --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <h1>Chat app</h1>
  <form method ="post" action ="" onsubmit="onsubmit_Form(); return false;">
    @csrf
    {{-- ニックネーム:<input type ="text" id="input_nickname" autocomplete="off">
    <br /> --}}
    メッセージ:<input type =" text" id ="input_message" autocomplete="off">
    <button type ="submit">送信</button>
  </form>

  <ul id = "list_message">
  </ul>
  <script>
    /* const elementInputNickname = document.getElementById("input_nickname"); */
    const elementInputMessage = document.getElementById("input_message");

    /* formのsubmitの処理 */
    function onsubmit_Form() {
      /* 送信用HTMLからInput要素の取得 */
      /* let strNickname = elementInputNickname.value; */
      let strMessage = elementInputMessage.value;
      if (!strMessage) {
        return;
      }
      /* if (!strNickname) {
        strNickname = "(匿名)";
      } */
      params = {
        /* 'nickname': strNickname, */
        'message': strMessage
      };

      /* Postリクエスト送信処理とレスポンスの取得処理 */
      axios
        .post('', params)
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error.response);
        })
      /* テキストHTML要素の中身をクリア */
      elementInputMessage.value = "";
    }
    /* ページ読み込み後の処理 */
    window.addEventListener( "DOMContentLoaded",()=>{
      const elementListMessage = document.getElementById("list_message");
      window.Echo.private('ToDo_Portfolio').listen('MessageSent',(e)=>{
        console.log(e);
        /* メッセージの整形 */
        let strUsername = e.message.username;
        let strMessage = e.message.body;

        /* メッセージをメッセージリストに追加 */
        let elementLi = document.createElement("li");
        let elementUsername = document.createElement("strong");
        let elementMessage = document.createElement("div");

        elementUsername.textContent = strUsername;
        elementMessage.textContent = strMessage;
        elementLi.append(elementUsername);
        elementLi.append(elementMessage);
        elementListMessage.prepend( elementLi );
      })
    })
  </script>
</body>

</html>
