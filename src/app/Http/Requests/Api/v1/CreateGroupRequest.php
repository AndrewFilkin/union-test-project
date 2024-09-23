<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroupRequest extends FormRequest
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
    {
        return [
            'parent_group_id' => 'int|regex:/^\d{1,100}$/',
            'with_page' => 'required|boolean',
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:3|max:250',
        ];
    }
}
