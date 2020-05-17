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

    /* public function add(Request $request)
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

    } */

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
                //"oldFruit"=>"",
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
        $producteur = Producteurs::find($datasToAdd['id_producteur']);
        if (!$producteur) {
            return 'err';
        }
        $addToDb->producteur()->associate($producteur);
        $addToDb->save();

        
        /**Fruits*/

        $fruits = [];
        if (is_array($datasToAdd['fruits'])) {
            foreach ($datasToAdd['fruits'] as $_fruit) {
                if (isset($_fruit['id'])) {
                    $fruit = Fruits::find($_fruit['id']);
                    if (!$fruit) {
                        return 'err';
                    }
                    $fruits[] = $fruit->id;
                } else {
                    return "id existe pas";
                    //On va créer un objet par la suite fruit:{name:""}
                }
            }
        }
        if (!empty($fruits)) {
            $addToDb->fruits()->attach($fruits);
        }
         
        return new ProduitResource($addToDb);

        /* withPivot, if exist detach else attach
        $pivot = Produits::wherePivotIn('id_fruit', '=', '1')->get();
        return ($pivot);*/
    }




}
