<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'name' => $this->name,
            'description' => $this->details,
            'price' => $this->price,
            'stock' => $this->stock == 0 ? "Out Of Stuck" : $this->stock,
            'discount' => $this->discount,
            'totalPrice' => round((1 - ($this->discount/100)) * $this->price),
            'rating' => $this->review->count() > 0 ? round($this->review->sum('stars')/$this->review->count()) : "No Rating Yet",
            'href' => [

                'reviews' => route('reviews.index',$this->id)

            ]

        ];
    }
}
