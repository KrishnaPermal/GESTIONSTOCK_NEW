<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class addProduitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $producteur =  new ProducteursResource($this->producteurs);
        $fruit =  new FruitsResource($this->fruits);

        return [
            'name' => $this->name,
            'producteur' => $producteur->name,
            'price'=>$this->price, 
            'fruits'=>$this->fruits,
        ];
    }
 }