<?php

namespace App\Http\Controllers;

use App\Articles;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    function index()
    {
        $articles =  Articles::with([
            'categories',
            'fournisseurs',
            'recompenses', 
        ])->get();
        return  ArticleResource::collection($articles);
    
    }

    function getCurrentUser(Request $request)
    {
        // A RECUPERER LE TOKEN 
        // RECUPERE LE USER QUI A LE TOKEN 
        // RETOURNE LE USER
    }
}
