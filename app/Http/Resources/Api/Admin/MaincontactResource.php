<?php

namespace App\Http\Resources\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

class MaincontactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'phones' => $this->phones,
            'emails' => $this->emails,
        ];
    }
}