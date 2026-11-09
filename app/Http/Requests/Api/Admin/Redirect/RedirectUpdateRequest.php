<?php

namespace App\Http\Requests\Api\Admin\Redirect;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RedirectUpdateRequest extends FormRequest
{
    use ResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:redirects,id'],
            ...RedirectRules::make((int) $this->input('id')),
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException($this->error($validator->errors()->first(), 422));
    }
}
