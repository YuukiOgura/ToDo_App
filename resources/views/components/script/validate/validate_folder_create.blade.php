<script>
  function validateFormFolder() {
    var titleInput = document.getElementById("title");
    var titleError = document.getElementById("titleError");

    if (titleInput.value === "") {
      titleError.textContent = "フォルダ名を入力してください。";
      titleError.style.display = "block";
      return false; // フォーム送信をキャンセル
    }
    if (titleInput.value.length > 20) {
      titleError.textContent = "フォルダー名は最大20文字としてください。";
      titleError.style.display = "block";
      return false;
    }

    return true; // フォーム送信を許可
  }
</script>
