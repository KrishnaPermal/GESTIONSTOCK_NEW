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


       /*  $addToDb = new  Produits;
        $addToDb->name = $datasToAdd['name'];
        $addToDb->price = $datasToAdd['price'];
        $addToDb->price = $datasToAdd['price'];
        $producteur = Producteurs::find($datasToAdd['id_producteur']);
        if (!$producteur) {
            return 'err';
        }
        $addToDb->producteur()->associate($producteur);
        $addToDb->save();  */


        /**Fruits*/

        /* $fruits = [];
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

        return new addProduitResource($addToDb);
    } */

    /* function updateProduit(Request $request, $id)
    {
        $dataUpdate = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "producteur" => "required",
                "fruits" => "required",
                "price" => "required",
            ]
        )->validate();

        $Producteur = Produits::where('id', '=', $id)
            ->first();
            if (!$Producteur){
                return "err";
            }
            else{
                $Producteur->nom = $dataUpdate['nom'];
                $Producteur->producer = $dataUpdate['producteur'];
                $Producteur->prix = $dataUpdate['price'];
                $Producteur->save();
            }


        return ($dataUpdate); */
    }














    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function addProduct(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'price' => 'required',
                'id_producteur' => 'required',
            ],
            [
                'required' => 'Le champs :attribute est requis', // :attribute renvoie le champs / l'id de l'element en erreure
            ]
        )->validate();

        $donneesBdd = Produits::create(
            $validator
        )->save();

        return $donneesBdd;
    }

    





}
