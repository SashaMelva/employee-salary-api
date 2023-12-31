<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesResource extends JsonResource
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
            'email' => $this->resource->email,
            'password' => $this->resource->password,
            'transactions' => TransactionsResource::collection($this->resource->transactions),
            'hourlyRates' => HourlyRatesResource::collection($this->resource->hourlyRates),
        ];
    }
}
