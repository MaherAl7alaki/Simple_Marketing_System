<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarketingPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($request->is('api/MarketingPage/details')) {
            return [
                'owner' => [
                    'id' => $this->user,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'image' => $this->image
                ],
                'id'=>$this->id,
                'name' => $this->name,
                'image' => $this->image,
                'category' => $this->category->category_name,
                'description' => $this->description
            ];
        }

        return [
            'id'=>$this->id,
            'name' => $this->name,
            'image' => $this->image,
            'category' => $this->category->category_name,
        ];
    }
}
