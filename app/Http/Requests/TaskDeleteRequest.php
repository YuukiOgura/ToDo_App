<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskDeleteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    { {
            return [
                // チェックボックスが選択されていること。
                'check_task' => 'required|array',
                // チェックされた各項目が存在するフォルダのIDがある事。
                'check_task.*' => 'required|integer|exists:tasks,id',
            ];
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'check_task.required' => '少なくとも1つのタスクを選択してください。',
            'check_task.*.exists' => '無効なタスクが選択されました。',
        ];
    }
}
