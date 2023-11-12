<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //バリデーションのルール策定
            'title_task' => 'required|string|max:20',
            'textarea' => 'required|string|max:255',
            'due_date' => 'required|date',
            'priority' => 'required|in:1,2,3',
        ];
    }

    public function messages()
    {
        return [
            'title_task.required' => 'タスク名を入力してください',
            'title_task.max' => 'タスク名は最大20文字としてください',
            'textarea.required' =>'タスクの説明文を入力してください',
            'textarea.max' =>'タスクの説明文は最大255文字としてください',
            'due_date.required' =>'期限日を設定してください',
            'priority.required' =>'重要度を選択してください'
        ];
    }
}
