<?php

namespace App\Http\Controllers;

use App\Fruits;
use Illuminate\Http\Request;

class FruitsController extends Controller
{
    //
    function index(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $users = Fruits::where('name', 'like', '%' . $query . '%')->get();
            return response()->json($users);
        }
    }
}
