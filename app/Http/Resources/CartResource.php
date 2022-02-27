<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'unique_id'         => $this->unique_id,
            'total_amount'      => $this->total,
            'total_count'       => $this->products()->count(),
            'products'          => $this->products->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'title'         => $item->title,
                    'price'         => $item->price,
                    'count'         => $item->pivot->count,
                    'photo'         => $item->photo,
                    'total_amount'  => $item->pivot->count * $item->price,
                ];
            })
        ];
    }
}
