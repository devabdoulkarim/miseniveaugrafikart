<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:tags,name,'.$this->route('tag')?->id],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Un tag avec ce nom existe déjà.',
        ];
    }
}
