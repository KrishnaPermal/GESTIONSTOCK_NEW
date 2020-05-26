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
        $product = Produits::with(['producteur','fruits'])->find($datasToAdd['id']);
        if (!$product) {
            $addToDb = new Produits;
            
        } else {
            $addToDb = $product;
            
        }
        if (isset($addToDb)){

        $addToDb->name = $datasToAdd['name'];
        $addToDb->price = $datasToAdd['price'];
        $addToDb->quantity = $datasToAdd['quantity'];
 
        
            $producteur = Producteurs::find($datasToAdd['id_producteur']);
            if (!$producteur) {
                return 'err';
        
            }
            $addToDb->producteur()->associate($producteur);

            if (isset($addToDb->photo)) { //Si ceci est vrai, alors on save dans la base
                $addToDb->save();
            } else {
                $img = $request->get('photo'); // Sinon envoie une requête
                
                $exploded = explode(",", $img); // explode retourne une chaîne de caractère
                
                if (str::contains($exploded[0], 'gif')) { // si la chaîne donnée contient la valeur donnée 'gif'
                    $ext = 'gif'; // exter
                } else if (str::contains($exploded[0], 'png')) { // sinon si 'png'
                    $ext = 'png'; 
                } else {
                    $ext = 'jpeg'; // sinon 'jpeg'
                }

                
                $decode = base64_decode($exploded[1]); // ici on va encodée sous forme de chaîne de caractère
                
                $filename = str::random() . "." . $ext; // génère une chaîne aléatoire
                $path = public_path() . "/storage/images/" . $filename; // renvoie le chemin d'accès complet au répertoire public
                if (file_put_contents($path, $decode)) { // si Écrit le résultat dans le fichier
                    $addToDb->photo = "/storage/images/" . $filename; // ajout photo dans /storage/images/
                }
            }

        
        $addToDb->save(); // on save

        
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