<?php

namespace App\Http\Resources\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Resources\JsonResource;

class RedirectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'source_path' => $this->source_path,
            'target_url' => $this->target_url,
            'status_code' => $this->status_code,
            'is_active' => $this->is_active,
            'preserve_query' => $this->preserve_query,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
