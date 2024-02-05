<script>
    document.getElementById('delete_folder').addEventListener('submit', function(event) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"][name="check_folder[]"]');
        var checked = false;
        var folderError = document.getElementById("folderError");
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checked = true;
            }
        });

        if (!checked) {
            folderError.textContent = "少なくとも1つのフォルダを選択してください。";
            folderError.style.display = "block";
            event.preventDefault(); // フォームの送信を中止
        } else {
            var confirmSubmit = confirm("本当に削除してもよいですか？");
            if (!confirmSubmit) {
                event.preventDefault(); // フォームの送信を中止
            }
        }
    });
</script>