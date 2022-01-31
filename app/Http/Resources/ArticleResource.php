<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ArticleResource extends JsonResource
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
            'id' => $this->id,
            'name' => Str::lower($this->name),
            'description' => Str::lower($this->description),
            'price' => $this->price,
            'quantity' => $this->quantity,
            'date' => $this->created_at->format('d-m-Y'),
        ];
    }

    public function with($request){
        return[
            'res'=> true
        ];
    }
}
