<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FournisseursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //$user = new UsersResource($this->users);

        return [
            'id' =>$this->id,
            'name' => $this->name,
            'firstname' => $this->firstname,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            //'id_users' => $this->$user,
            
        ];
    }
}
