<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProduitResource;
use App\Produits;
use Illuminate\Http\Request;

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
}
