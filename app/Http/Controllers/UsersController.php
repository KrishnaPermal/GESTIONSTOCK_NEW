<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    function index()
    {
       $user =  User::get();
       return $user;
    }
}
