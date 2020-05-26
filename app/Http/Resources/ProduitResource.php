<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProduitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $producteur = new ProducteursResource($this->whenLoaded('producteur'));
        $fruits = FruitsResource::collection($this->whenLoaded('fruits'));
        $recompenses = RecompensesResource::collection($this->whenLoaded('recompenses'));

        return [
            'id' =>$this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'producteur' => $producteur,
            'fruits' => $fruits,
            'recompenses' => $recompenses,
            'id_producteur'=>$this->id_producteur,
            'photo' => $this->photo,
        ];

    }
}
