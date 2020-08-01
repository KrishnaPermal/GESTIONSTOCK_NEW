<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Fournisseurs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('home.main');
    }

    public function delete($id)
    {

        $fournisseurs = Fournisseurs::where("id_users", "=", $id)->get();

        foreach ($fournisseurs as $fournisseur) {
            $articles = Articles::where("id_fournisseur", "=", $fournisseur->id)->get();
            foreach ($articles as $article) {
               $article->delete();
            }
            $fournisseur->delete();
        }

        $deleteUser = User::destroy("id", "=", $id) ? 'ok' : 'nok';
        return $deleteUser;

    }

    public function addOrUpdateClient(Request $request) {
        $valide_client = Validator::make(
            $request->all(),
            [
                "email" => "required",
                "name" => 'required',
                'id' => ''
            ]
        )->validate();

        $client = User::find($valide_client['id']);
        if (!$client) {
            $addToClientDb = new User();

        } else {
            $addToClientDb = $client;

        }
        if (isset($addToClientDb)) {

            $addToClientDb->email = $valide_client['email'];
            $addToClientDb->name = $valide_client['name'];
            $addToClientDb->password = bcrypt('client');
            $addToClientDb->id_role = 2;
            $addToClientDb->save();
            return $addToClientDb;
         } 
    }

}
