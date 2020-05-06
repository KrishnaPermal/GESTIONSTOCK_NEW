<?php

namespace App\Http\Controllers;

use App\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function index()
    {
        return view('home.main');
    }
    function addProduit(REQUEST $request)
    {
        $datasToAdd = Validator::make(
            $request->input(),
            [
                "name" => "required",
                "quantity" => "required",
                "price"=>"required",
                "id_producteur"=>"required",
            ],
            [
                'required' => 'Le champ :attribute est requis'
            ]
        )->validate();

        $addToBdd = Produits::create($datasToAdd);
        return $addToBdd;
    }
}
