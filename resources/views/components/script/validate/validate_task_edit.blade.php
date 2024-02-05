<script>
    function validateFormTaskEdit() {
      const folderEditSelect = document.getElementById('folders_select_edit');
      const folderEditError = document.getElementById('folderEditError');
      const priority1Edit = document.getElementById('priority1Edit');
      const priority2Edit = document.getElementById('priority2Edit');
      const priority3Edit = document.getElementById('priority3Edit');
      const priorityEditError = document.getElementById('priorityEditError');
      const titleTaskEdit = document.getElementById('title_task_edit');
      const taskTitleEditError = document.getElementById('taskTitleEditError');
      const textareaEdit = document.getElementById('textareaEdit');
      const textareaEditError = document.getElementById('textareaEditError');
      const dueDateEdit = document.getElementById('due_date_edit');
      const dueDateEditError = document.getElementById('dueDateEditError');
      let errors = [];
  
      if (!folderEditSelect.value) {
        errors.push("フォルダを選択してください。");
      }
  
      if (!priority1Edit.checked && !priority2Edit.checked && !priority3Edit.checked) {
        errors.push("重要度を選択してください。");
      }
      if (!titleTaskEdit.value.trim()) {
        errors.push("タスク名を入力してください");
      }
  
      if (titleTaskEdit.value.length > 20) {
        errors.push("タスク名は最大20文字としてください。");
      }
      if (!textareaEdit.value.trim()) {
        errors.push("タスクの説明文を入力してください。");
      }
      if (textareaEdit.value.length > 255) {
        errors.push("タスクの説明文は最大255文字としてください。");
      }
      if (!dueDateEdit.value) {
        errors.push("期限日を設定してください。");
      }
  
      if (errors.length > 0) {
        //初期化
        folderEditError.textContent = "";
        priorityEditError.textContent = "";
        taskTitleEditError.textContent = "";
        textareaEditError.textContent = "";
        dueDateEditError.textContent = "";
  
        errors.forEach(error => {
          if (error === "フォルダを選択してください。") {
            folderEditError.textContent = error;
            folderEditError.style.display = "block";
          } else if (error === "重要度を選択してください。") {
            priorityEditError.textContent = error;
            priorityEditError.style.display = "block";
          } else if (error === "タスク名を入力してください") {
            taskTitleEditError.textContent = error;
            taskTitleEditError.style.display = "block";
          } else if (error === "タスク名は最大20文字としてください。") {
            taskTitleEditError.textContent = error;
            taskTitleEditError.style.display = "block";
          } else if (error === "タスクの説明文を入力してください。") {
            textareaEditError.textContent = error;
            textareaEditError.style.display = "block";
          } else if (error === "タスクの説明文は最大255文字としてください。") {
            textareaEditError.textContent = error;
            textareaEditErrorr.style.display = "block";
          } else if (error === "期限日を設定してください。") {
            dueDateEditError.textContent = error;
            dueDateEditError.style.display = "block";
          }
        });
        return false;
      }
      return true;
    }
  </script>
  