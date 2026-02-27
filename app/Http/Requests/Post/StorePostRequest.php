<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:2000',
            'category_id' => 'nullable|integer|max:255',
            'slug' => 'required|string|max:255',
            'user_id' => 'nullable|integer|max:255',
            'tags' => 'array',
            'is_published' => 'boolean',
        ];
    }
}
