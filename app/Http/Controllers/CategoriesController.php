<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    function index(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $users = Categories::where('name', 'like', '%' . $query . '%')->get();
            return response()->json($users);
        }
    }
}
