<?php

namespace App\Http\Requests\Api\Admin\Video;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:videos,id',
            'url' => 'sometimes|required|url|max:2048',
            'title' => 'sometimes|required|array|min:1',
            'title.*' => 'required|string|max:255',
            'product_id' => 'sometimes|required|integer|exists:products,id',
        ];
    }
}
