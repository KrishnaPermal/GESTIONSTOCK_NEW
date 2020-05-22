<?php

namespace App\Http\Controllers;

use App\Fruits;
use App\Http\Resources\PhotosResource;
use App\Http\Resources\ProduitResource;
use App\PhotosModel;
use App\Producteurs;
use App\Produits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        $produits = Produits::with(['producteur','fruits','recompenses','photo'])->get();
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
                "id_photo" => "",
                "fruits" => "",
              
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();
        $product = Produits::with(['producteur','photo','fruits'])->find($datasToAdd['id']);
        if (!$product) {
            $addToDb = new Produits;
            
        } else {
            $addToDb = $product;
            
        }

        if (isset($addToDb)){

        $addToDb->name = $datasToAdd['name'];
        $addToDb->price = $datasToAdd['price'];
        $addToDb->quantity = $datasToAdd['quantity'];
        if ($product && isset($product->producteur) && $datasToAdd['id_producteur'] != $product->producteur->id){       
 
            $producteur = Producteurs::find($datasToAdd['id_producteur']);
            if (!$producteur) {
                return 'err';
        
            }
            $addToDb->producteur()->associate($producteur);
        }
        if ($product && isset($product->photo) && $datasToAdd['id_photo'] != $product->photo->id){       
      
            $photo = PhotosModel::find($datasToAdd['id_photo']);
            if (!$photo) {
                return 'err';
        
            }
            $addToDb->photo()->associate($photo);
        }

        
        $addToDb->save();

        
        /**Fruits*/

        $produitFruits = [];
        $clientFruits = $datasToAdd['fruits'];
        $detachArray = []; //stocker les id que l'ont devra supprimer (detach)
        $attachArray = []; //stocker les id que l'ont devra ajouter (attach)
        $idClientFruits = [];
        

        foreach ($clientFruits as $_clientFruit) { //sert à recuperé les id des fruits
            $idClientFruits[] = $_clientFruit['id'];
        }
        if ($product && isset($product->fruits)) { // le 2eme verifie si product existe et qu'il y a bien des fruits 
            foreach ($product->fruits as $_fruits) { 
                $produitFruits[] = $_fruits->id; // puis ils leur attribue une id
            }
        }
        foreach ($idClientFruits as $_clientFruit) { // comparaison pour savoir si chacun des idClientFruits as _clientFruit 
            if (!in_array($_clientFruit, $produitFruits)) { //présent dans produitFruits
                $attachArray[] = $_clientFruit; // ont rajoute
            }
        }
        foreach ($produitFruits as $_produitFruit) { // comparaison ici pour savoir les même choses avec produitFruits 
            if (!in_array($_produitFruit, $idClientFruits)) {
                $detachArray[] = $_produitFruit; // ont supprime
            }
        }
        if (!empty($detachArray)) {
            $addToDb->fruits()->detach($detachArray);
        }
        if (!empty($attachArray)) {
            $addToDb->fruits()->attach($attachArray);
        } 

       
        return new ProduitResource($addToDb); 
    }
    }

    /* withPivot, if exist detach else attach
        $pivot = Produits::wherePivotIn('id_fruit', '=', '1')->get();
        return ($pivot);*/


}