<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WisataResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => $this->resource !== null,
            'message' => $this->when($this->resource !== null, $this->message),
            'data' => $this->resource
        ];
    }
}
