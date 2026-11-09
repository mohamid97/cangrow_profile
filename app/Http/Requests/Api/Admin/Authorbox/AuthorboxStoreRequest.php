<?php

namespace App\Http\Requests\Api\Admin\Authorbox;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthorboxStoreRequest extends FormRequest
{
    use ResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_name' => ['required', 'array', 'min:1'],
            'author_name.*' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5000'],
            'specialty' => ['nullable', 'array'],
            'specialty.*' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'array'],
            'bio.*' => ['nullable', 'string', 'max:5000'],
            'profile_link' => ['nullable', 'url', 'max:2048'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException($this->error($validator->errors()->first(), 422));
    }
}
