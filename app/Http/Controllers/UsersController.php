<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UsersResource;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        /* $articles = Articles::with([
            'categories',
            'fournisseurs',
            'recompenses',
        ])->get();
        return ArticleResource::collection($articles); */

        //recupere tous les categories
        $user = User::where('id_role', '=', 2)->get();
        //Retourne la data categories
        return UsersResource::collection($user);
    }
    
   

    

    public function delete($id)
    {
        $status = User::destroy($id) ? "ok" : "nok";
        return $status;
    }
}
