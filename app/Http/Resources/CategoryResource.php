<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            $this->attributes([
                'id',
                'parent_id',
                'sort_order',
                'title',
                'slug',
                'description',
                'meta_title',
                'meta_description',
            ]),
            'sub_categories' => CategoryResource::collection($this->whenLoaded('subCategories')),
        ];
    }
}
