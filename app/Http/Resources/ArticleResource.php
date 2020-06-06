<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        $fournisseur = new FournisseursResource($this->whenLoaded('fournisseur'));
        $categories = CategoriesResource::collection($this->whenLoaded('categories'));
      //$recompenses = RecompensesResource::collection($this->whenLoaded('recompenses'));
      
        return [
            'id' =>$this->id,
            'article_ref' => $this->article_ref,
            'mark' => $this->mark,
            'description' => $this->description,
            'provider' => $this->provider,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'fournisseur' => $fournisseur,
            'categories' => $categories,
            'id_fournisseur'=>$this->id_fournisseur,
            'photo' => $this->photo,
        ];
    }
}
