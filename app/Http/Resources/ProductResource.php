<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($request->is('api/product/') ||
            $request->is('api/product/create' ||
                $request->is('api/product/update'))){
            return [
                'id' =>$this->id,
                'name' => $this->name,
                'description' =>$this->description,
                'price' =>$this->price,
                'image' => $this->image,
            ];
        }

        return [
            'id' =>$this->id,
            'name' => $this->name,
            'price' =>$this->price,
            'image' => $this->image,
        ];
    }
}
