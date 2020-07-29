<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});  */


/*******************************************************/
Route::get('categories', 'CategoriesController@index');
Route::get('articles', 'ArticleController@index');
/*******************************************************/



/************************Sécurisation des routes (entrées du serveur)******************************/





/*****************************LOGIN/LOGOUT/REGISTER**********************/

Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout')->middleware('auth:api');
Route::post('/register', 'AuthController@register');

/*****************************LOGIN/LOGOUT/REGISTER***********************/




/*****************************************ARTICLES*************************************************/

Route::middleware(['auth:api', 'roles:Admin|Fournisseur'])->prefix('articles')->group(function () {
    Route::post('/', 'ArticleController@createOrUpdate');
    Route::delete('/{id}', 'ArticleController@delete')->where('id', "[0-9]+");
});

/*****************************************ARTICLES**************************************************/




/**********************************DELETE CLIENT*********************************/

Route::delete('/{id}/client', 'AdminController@delete')->where('id', "[0-9]+");

/**********************************DELETE CLIENT*********************************/




/***********************ACCESSIBLE FOURNISSEUR*******************************/

// Récupère les articles du Fournisseur (accessible qu'au fournisseur)
Route::middleware(['auth:api', 'roles:Fournisseur'])->prefix('fournisseurs')->group(function () {
    Route::get('articles', 'ArticleController@getOfFournisseur');
    Route::post('articles', 'ArticleController@createOrUpdate');
});

/*****************************************************************************/



/************************************COMMANDES****************************************************/

Route::middleware(['auth:api', 'roles:Fournisseur|Client'])->group(function () {
    Route::post('/commandes', 'CommandesController@pushPanier');
    //Route::get('/commandes', '');
    //Route::get('/commandes/{id}', '')->where('id','');
    Route::post('/commandes/{id}/payment', 'CommandesController@payment')->where('id', '[0-9]+');
});

/************************************COMMANDES****************************************************/




/******************************CLIENTS****************************************/

Route::middleware(['auth:api', 'roles:Admin'])->prefix('clients')->group(function () {
    Route::get('/', 'UsersController@index');

});

/*****************************************************************************/



/******************************CATEGORIES*************************************/

Route::get('articles/categories', 'ArticleController@getCategories')->middleware(['auth:api']);

/*****************************************************************************/












/****route currentUser****/
//Route::post('/currentUser', 'UsersController@getCurrentUserDB');
/****route currentUser****/
//Route::get('Fruits', 'FruitsController@index');
//Route::get('users', 'UsersController@index');