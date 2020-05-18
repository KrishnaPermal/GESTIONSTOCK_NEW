<?php

namespace App\Http\Controllers;

use App\Fruits;

use App\Http\Resources\ProduitResource;
use App\Producteurs;
use App\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    /**Afficher tout dans un tableau depuis BDD**/
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

    
    /**Ajout d'un Produit & Modifier*/

    public function createOrUpdate(Request $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "id" => "",
                "name" => "required",
                "price" => "required",
                "quantity" => "required",
                "id_producteur" => "required|numeric",
                "fruits" => "",
              
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();
        $product = Produits::find($datasToAdd['id']);
        if (!$product) {
            $addToDb = new Produits;
            Log::debug('CreateProduct');
        } else {
            $addToDb = $product;
            Log::debug('UpdateProduct');
        }

        $addToDb->name = $datasToAdd['name'];
        $addToDb->price = $datasToAdd['price'];
        $addToDb->quantity = $datasToAdd['quantity'];
        if ($product && isset($product->producteur) && $datasToAdd['id_producteur'] != $product->producteur->id){       
        } else {
            $producteur = Producteurs::find($datasToAdd['id_producteur']);
            if (!$producteur) {
                return 'err';
        
            }
            $addToDb->producteur()->associate($producteur);
        }

        $addToDb->save();

        
        /**Fruits*/

        $produitFruits = [];
        $clientFruits = [];
        $detachArray = []; //stocker les id que l'ont devra supprimer (detach)
        $attachArray = []; //stocker les id que l'ont devra ajouter (attach)

        foreach ($datasToAdd['fruits'] as $_clientFruit) { //sert à recuperé les id des fruits
            $clientFruits[] = $_clientFruit['id'];
        }
        if ($product && isset($product->fruits)) { // le 2eme verifie si product existe et qu'il y a bien des fruits 
            foreach ($product->fruits as $_fruits) { 
                $produitFruits[] = $_fruits->id; // puis ils leur attribue une id
            }
        }
        foreach ($clientFruits as $_clientFruit) { // comparaison pour savoir si chacun des clientFruits as _clientFruit 
            if (!in_array($_clientFruit, $produitFruits)) { //présent dans produitFruits
                $attachArray[] = $_clientFruit; // ont rajoute
            }
        }
        foreach ($produitFruits as $_produitFruit) { // comparaison ici pour savoir les même choses avec produitFruits 
            if (!in_array($_produitFruit, $produitFruits)) {
                $detachArray[] = $_produitFruit; // ont supprime
            }
        }
        if (!empty($detachArray)) {
            $product->fruits()->detach($detachArray);
        }
        if (!empty($attachArray)) {
            $product->fruits()->attach($attachArray);
        }

        return new ProduitResource($addToDb);
    }

    /* withPivot, if exist detach else attach
        $pivot = Produits::wherePivotIn('id_fruit', '=', '1')->get();
        return ($pivot);*/

}