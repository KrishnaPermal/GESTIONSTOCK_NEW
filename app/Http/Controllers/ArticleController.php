<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Categories;
use App\Fournisseurs;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoriesResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        //$articles = Articles::with(['fournisseur','categories'])->get();
        $articles = Articles::with(['fournisseur', 'categories'])->take(8)->get();
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
                'id_fournisseur' => "required",
                "categorie" => "required",
                'photo' => "",
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        )->validate();

        $product = Articles::with(['fournisseur', 'categories'])->find($datasToAdd['id']);
        if (!$product) {
            $addToDb = new Articles;

        } else {
            $addToDb = $product;

        }

        if (isset($addToDb)) {

            $addToDb->article_ref = $datasToAdd['article_ref'];
            $addToDb->mark = $datasToAdd['mark'];
            $addToDb->description = $datasToAdd['description'];
            $addToDb->provider = $datasToAdd['provider'];
            $addToDb->quantity = $datasToAdd['quantity'];
            $addToDb->price = $datasToAdd['price'];

            if (isset($datasToAdd['id_fournisseur'])) {
                $fournisseur = Fournisseurs::find($datasToAdd['id_fournisseur']);
                if (!$fournisseur) {
                    return 'err four';

                }

                $addToDb->fournisseur()->associate($fournisseur);

            } else {
                if (!isset($datasToAdd['id'])) {
                    $user = $request->user();
                    $fournisseur = Fournisseurs::where('id_users', '=', $user->id)->first();
                    if (!$fournisseur) {
                        return "err four 2";
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

            if (isset($datasToAdd['categorie'])) {

                $categories = Categories::find($datasToAdd['categorie']);

                $addToDb->categories()->associate($categories);

            } else {
                if (!isset($datasToAdd['id'])) {
                    $user = $request->user();
                    $categorie = Categories::where('id_users', '=', $user->id)->first();
                    if (!$categorie) {
                        return "err cat";
                    }

                    $addToDb->categories()->associate($categorie);
                }
            }
            // return $addToDb;
            $addToDb->save(); // on save
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
        $articles = Articles::whereHas('fournisseur', function (Builder $query) use ($user) {
            $query->where('id_users', '=', $user->id);
        })->get();

        return ArticleResource::collection($articles);
    }

    public function getCategories(Request $request)
    {
        $getCategories = Categories::all();

        return CategoriesResource::collection($getCategories);
    }

    public function delete($id)
    {
        $status = Articles::destroy($id) ? "ok" : "nok";
        return $status;
    }

}
