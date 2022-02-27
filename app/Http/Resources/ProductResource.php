<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
          'title'       => $this->title,
          'description' => $this->description,
          'photo'       => $this->photo,
          'stock'       => !empty($this->stock) ? $this->stock : 'out of order',
          'price'       => number_format($this->price),
        ];
    }
}
