<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProduitResource;
use App\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    function index()
    {
        $produits =  Produits::with([
            'fruits',
            'producteurs',
            'recompenses', 
        ])->get();
        return  ProduitResource::collection($produits);
    
    }

    function getCurrentUser(Request $request)
    {
        // A RECUPERER LE TOKEN 
        // RECUPERE LE USER QUI A LE TOKEN 
        // RETOURNE LE USER
    }
}
