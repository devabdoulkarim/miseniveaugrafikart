<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,'.$this->route('category')?->id],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Une catégorie avec ce nom existe déjà.',
        ];
    }
}
