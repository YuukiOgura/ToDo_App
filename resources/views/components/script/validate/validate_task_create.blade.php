<script>
  function validateFormTask() {
    const folderSelect = document.getElementById('folders_select');
    const folderError = document.getElementById('folderError');
    const priority1 = document.getElementById('priority1');
    const priority2 = document.getElementById('priority2');
    const priority3 = document.getElementById('priority3');
    const priorityError = document.getElementById('priorityError');
    const titleTask = document.getElementById('title_task');
    const taskTitleError = document.getElementById('taskTitleError');
    const textarea = document.getElementById('textarea');
    const taskTextareaError = document.getElementById('taskTextareaError');
    const dueDate = document.getElementById('due_date');
    const dueDateError = document.getElementById('dueDateError');
    let errors = [];

    if (!folderSelect.value) {
      errors.push("フォルダを選択してください。");
    }

    if (!priority1.checked && !priority2.checked && !priority3.checked) {
      errors.push("重要度を選択してください。");
    }
    if (!titleTask.value.trim()) {
      errors.push("タスク名を入力してください");
    }

    if (titleTask.value.length > 20) {
      errors.push("タスク名は最大20文字としてください。");
    }
    if (!textarea.value.trim()) {
      errors.push("タスクの説明文を入力してください。");
    }
    if (textarea.value.length > 255) {
      errors.push("タスクの説明文は最大255文字としてください。");
    }
    if (!dueDate.value) {
      errors.push("期限日を設定してください。");
    }

    if (errors.length > 0) {
      //初期化
      folderError.textContent = "";
      priorityError.textContent = "";
      taskTitleError.textContent = "";
      taskTextareaError.textContent = "";
      dueDateError.textContent = "";

      errors.forEach(error => {
        if (error === "フォルダを選択してください。") {
          folderError.textContent = error;
          folderError.style.display = "block";
        } else if (error === "重要度を選択してください。") {
          priorityError.textContent = error;
          priorityError.style.display = "block";
        } else if (error === "タスク名を入力してください") {
          taskTitleError.textContent = error;
          taskTitleError.style.display = "block";
        } else if (error === "タスク名は最大20文字としてください。") {
          taskTitleError.textContent = error;
          taskTitleError.style.display = "block";
        } else if (error === "タスクの説明文を入力してください。") {
          taskTextareaError.textContent = error;
          taskTextareaError.style.display = "block";
        } else if (error === "タスクの説明文は最大255文字としてください。") {
          taskTextareaError.textContent = error;
          taskTextareaError.style.display = "block";
        } else if (error === "期限日を設定してください。") {
          dueDateError.textContent = error;
          dueDateError.style.display = "block";
        }
      });
      return false;
    }
    return true;
  }
</script>
