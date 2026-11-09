<?php

namespace App\Http\Requests\Api\Admin\Redirect;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RedirectStoreRequest extends FormRequest
{
    use ResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return RedirectRules::make();
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException($this->error($validator->errors()->first(), 422));
    }
}
