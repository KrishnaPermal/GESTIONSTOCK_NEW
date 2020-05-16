<?php

namespace App\Http\Controllers;

use App\Fruits;
use App\Http\Resources\addProduitResource;
use App\Http\Resources\ProduitResource;
use App\Producteurs;
use App\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produits::with(['producteur','fruits','recompenses'])->get();
        return ProduitResource::collection($produits);
    }

    /**Ajout d'un Produit*/
    public function add(Request $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "price" => "required",
                "quantity" => "required",
                "id_producteur" => "required|numeric",
                //"fruits" => "required",
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();
        //Ajout en bdd des données validées par le validator

        $produits =Produits::create($datasToAdd);

        //Retourne le produit formaté grâce à la ressource

        return new ProduitResource($produits);

    }

    /* public function viewFruits() {
        return Fruits::all();
    } */
    

    





}
