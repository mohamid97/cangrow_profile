<?php

namespace App\Http\Requests\Api\Admin\Application;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApplicationStoreRequest extends FormRequest
{
    use ResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif|max:5000',
            'title' => 'required|array|min:1',
            'title.*' => 'required|string|max:255',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->error($validator->errors()->first(), 422));
    }
}
