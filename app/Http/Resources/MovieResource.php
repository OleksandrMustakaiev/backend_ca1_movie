<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'title' => $this->title,
            'year' => $this->year,
            'category' => $this->category,
            'rating' => $this->rating,
            'production_company_id' => $this->production_company->id,
            'production_company_name' => $this->production_company->name,
            'production_company_address' => $this->production_company->address
        ];
    }
}
