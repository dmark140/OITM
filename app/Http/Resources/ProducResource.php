<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProducResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "cid"=> $this->cid,
            "itemCode"=> $this->itemCode,
            "itemName"=> $this->itemName,
            "quantity"=> $this->quantity,
            "min"=> $this->min,
            "max"=> $this->max,
        ];
    }
}
