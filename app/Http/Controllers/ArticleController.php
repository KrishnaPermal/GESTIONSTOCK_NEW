<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Fournisseurs;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\PhotosResource;
use App\Http\Resources\ProduitResource;
use App\PhotosModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**Afficher tout dans un tableau depuis BDD**/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::with(['fournisseur','categories'])->get();
        return ArticleResource::collection($articles);
    }

    
    /**Ajout d'un Produit & Modifier*/

    public function createOrUpdate(Request $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                'id' => "",
                'article_ref' => "required",
                'mark' => "required",
                'description' => "required",
                'provider' => "required",
                'quantity' => "required",
                'price' => "required",
                'id_fournisseur' => "numeric",
                "categories" => "",
                'photo' => "",
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();
        $product = Articles::with(['fournisseur','categories'])->find($datasToAdd['id']);
        if (!$product) {
            $addToDb = new Articles;
            
        } else {
            $addToDb = $product;
            
        }
        if (isset($addToDb)){

        $addToDb->article_ref = $datasToAdd['article_ref'];
        $addToDb->mark = $datasToAdd['mark'];
        $addToDb->description = $datasToAdd['description'];
        $addToDb->provider = $datasToAdd['provider'];
        $addToDb->quantity = $datasToAdd['quantity'];
        $addToDb->price = $datasToAdd['price'];
 
        if(isset($datasToAdd['id_fournisseur'])){
            $fournisseur = Fournisseurs::find($datasToAdd['id_fournisseur']);
            if (!$fournisseur) {
                return 'err';
        
            }
            $addToDb->fournisseur()->associate($fournisseur);
        } else{
            if(!isset($datasToAdd['id'])){
                    $user = $request->user();
                    $fournisseur = Fournisseurs::where('id_users', '=', $user->id)->first();
                    if(!$fournisseur){
                        return $datasToAdd;
                        return "err";
                    }
                    $addToDb->fournisseur()->associate($fournisseur);
            }
        }
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

        $articleCategories = [];
        $clientCategories = $datasToAdd['categories'];
        $detachArray = []; //stocker les id que l'ont devra supprimer (detach)
        $attachArray = []; //stocker les id que l'ont devra ajouter (attach)
        $idClientCategories = [];
        

        foreach ($clientCategories as $_clientCategorie) { //sert à recuperé les id des categories
            $idClientCategories[] = $_clientCategorie['id'];
        }
        if ($product && isset($product->categories)) { // le 2eme verifie si product existe et qu'il y a bien des categories 
            foreach ($product->categories as $_categories) { 
                $articleCategories[] = $_categories->id; // puis ils leur attribue une id
            }
        }
        foreach ($idClientCategories as $_clientCategorie) { // comparaison pour savoir si chacun des idClientCategories as _clientCategorie
            if (!in_array($_clientCategorie, $articleCategories)) { //présent dans articleCategories
                $attachArray[] = $_clientCategorie; // ont rajoute
            }
        }
        foreach ($articleCategories as $_articleCategorie) { // comparaison ici pour savoir les même choses avec articleCategories 
            if (!in_array($_articleCategorie, $idClientCategories)) {
                $detachArray[] = $_articleCategorie; // ont supprime
            }
        }
        if (!empty($detachArray)) {
            $addToDb->categories()->detach($detachArray);
        }
        if (!empty($attachArray)) {
            $addToDb->categories()->attach($attachArray);
        } 

       
        }

    return new ArticleResource($addToDb); 

    }

    /* withPivot, if exist detach else attach
        $pivot = Produits::wherePivotIn('id_fruit', '=', '1')->get();
        return ($pivot);*/





        //Remonte tout les produits qui appartiennent aux producteurs, qui a pour id_users  notre id_users connecté

        public function getOfFournisseur(Request $request)
        {
            $user = $request->user();
            $articles = Articles::with(['categories'])->whereHas('fournisseur', function (Builder $query) use ($user) {
                $query->where('id_users', '=', $user->id);
            })->get();
    
            return ArticleResource::collection($articles);
        }



}