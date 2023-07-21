<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'employee_id'=> $this->resource->employee_id,
            'status_id'=> $this->resource->status_id,
            'hours' => $this->resource->hours,
            'price' => $this->resource->price
        ];
    }
}
