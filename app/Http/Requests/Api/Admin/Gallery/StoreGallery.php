<?php

namespace App\Http\Requests\Api\Admin\Gallery;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreGallery extends FormRequest
{
    use ResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'new_images' => 'nullable|array',
            'new_images.*.file' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
            'new_images.*.order' => 'nullable|integer',
            'old_order' => 'nullable|array',
            'old_order.*id' => 'nullable|integer',
            'old_order.*order' => 'nullable|integer',
            'model' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $modelClass = 'App\\Models\\Api\\Admin\\' . ucfirst($value);
                    $galleryModelClass = $modelClass . 'Gallery';
                    if (!class_exists($modelClass) || !class_exists($galleryModelClass)) {
                        $fail("The model '{$value}' is not a valid gallery model.");
                    }
                }
            ],
        ];

        $model = $this->input('model');
        if ($model) {
            $foreignKey = $model . '_id';
            $modelClass = 'App\\Models\\Api\\Admin\\' . ucfirst($model);
            if (class_exists($modelClass)) {
                $rules[$foreignKey] = 'required|integer|exists:' . $modelClass . ',id';
            }
        }

        return $rules;
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->error(
                $validator->errors()->first(),
                422,

            )
        );
    }




}