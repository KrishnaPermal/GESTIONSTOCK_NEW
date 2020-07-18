<?php

namespace App\Http\Controllers;

use App\Fournisseurs;
use App\User;
use App\Http\Resources\ProducteursResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FournisseursController extends Controller
{
    /* public function getProducteurs()
    {
        $producteurs = Producteurs::get();
        return ProducteursResource::collection($producteurs);      
    }  
    public function addOrUpdate(Request $request) 
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "id" => "",
                "id_users" => "",
                "email" => "",
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();
        $producteur = Producteurs::find($datasToAdd['id']);
        if ($producteur) {
            $producteur->name = $datasToAdd['name'];
            $producteur->save();
        } else {
            throw 'err';
        }
        $user = User::find($datasToAdd['id_users']);
        if ($user) {
            
            $user->email = $datasToAdd['email'];
            $user->save();
        } else {
            throw 'err';
        }
        return new ProducteursResource($producteur);
    } */
}
