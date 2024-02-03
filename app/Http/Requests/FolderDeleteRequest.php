<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolderDeleteRequest extends FormRequest
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
                'check_folder' => 'required|array',
                // チェックされた各項目が存在するフォルダのIDがある事。
                'check_folder.*' => 'required|integer|exists:folders,id',
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
            'check_folder.required' => '少なくとも1つのフォルダを選択してください。',
            'check_folder.*.exists' => '無効なフォルダが選択されました。',
        ];
    }
}
