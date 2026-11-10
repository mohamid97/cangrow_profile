<?php

namespace App\Http\Requests\Api\Admin\Authorbox;

use Illuminate\Foundation\Http\FormRequest;

class AuthorboxStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
            'profile_link' => 'nullable|string|max:2048',
            'author_name' => 'required|array',
            'author_name.*' => 'required|string|max:255',
            'specialty' => 'nullable|array',
            'specialty.*' => 'nullable|string|max:255',
            'bio' => 'nullable|array',
            'bio.*' => 'nullable|string|max:5000',
        ];
    }
}
