<?php

namespace App\Http\Requests\Api\Admin\Video;

use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'url' => 'required|url|max:2048',
            'title' => 'required|array|min:1',
            'title.*' => 'required|string|max:255',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }
}
