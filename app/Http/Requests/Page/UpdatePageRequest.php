<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', 'unique:pages,slug'],
            'content' => ['sometimes', 'string'],
            'is_published' => ['sometimes', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
            'user_id' => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
