<?php

namespace App\Http\Requests\Api\Admin\Authorbox;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthorboxUpdateRequest extends FormRequest
{
    use ResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:authorboxes,id',
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error($validator->errors()->first(), 422));
    }
}
