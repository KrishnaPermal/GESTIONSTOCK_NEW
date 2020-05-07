<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        return $login;
        if(!Auth::attempt($login)){
            return response(['message' => 'Login invalide.']);
        }

        $accessToken = Auth::user()->createToken('authToken')->$accessToken;

        return Auth::user();

        //return new UserResource(Auth::user($accessToken),$accessToken);
    }

    /**
     * Logout to the app
     * 
     *  
     */

}
