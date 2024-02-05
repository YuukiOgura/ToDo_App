<script>
  document.getElementById('taskBackOrDelete').addEventListener('submit', function(event) {
    const deleteCheckbox = document.getElementById('delete');
    const updateCheckbox = document.getElementById('update');
    const taskBackOrDeleteError = document.getElementById('taskBackOrDeleteError');
    var checkBoxesTask = document.querySelectorAll('input[type="checkbox"][name="check_task[]"]');
    var taskBackOrDeleteCheckedError = document.getElementById('taskBackOrDeleteCheckedError');
    var checkedTask = false;
    let errorsTask = [];
    checkBoxesTask.forEach(function(checkboxtask) {
      if (checkboxtask.checked) {
        checkedTask = true;
      }
    });
    if (!checkedTask) {
      errorsTask.push("少なくとも1つのタスクを選択してください。")
      /* taskBackOrDeleteCheckedError.textContent = "少なくとも1つのタスクを選択してください";
      taskBackOrDeleteCheckedError.style.display ="block";
      event.preventDefault(); // フォームの送信を中止 */
    }
    if (!deleteCheckbox.checked && !updateCheckbox.checked) {
      errorsTask.push("どちらかを選択してください。");
    }

    if (errorsTask.length > 0) {
      taskBackOrDeleteError.textContent = "";
      errorsTask.forEach(error => {
        if (error === "どちらかを選択してください。") {
          taskBackOrDeleteError.textContent = error;
          taskBackOrDeleteError.style.display = "block";
        } else if (error === "少なくとも1つのタスクを選択してください。") {
          taskBackOrDeleteCheckedError.textContent = error;
          taskBackOrDeleteCheckedError.style.display = "block";
        }
      });
      event.preventDefault(); // フォームの送信を防止
    }
  });
</script>
