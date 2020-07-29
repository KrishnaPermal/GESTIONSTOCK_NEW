<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Fournisseurs;
use App\User;

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

}
