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

/*LOGIN/LOGOUT/REGISTER*/

Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout')->middleware('auth:api');
Route::post('/register', 'AuthController@register');

/*LOGIN/LOGOUT/REGISTER*/

// Sécurisation de la route
Route::middleware(['auth:api', 'roles:Admin|Fournisseur'])->prefix('articles')->group(function () {
    Route::post('/', 'ArticleController@createOrUpdate');
    Route::delete('/{id}', 'ArticleController@delete')->where('id', "[0-9]+");
});

// Récupère les articles du Fournisseur (accessible qu'au fournisseur)
Route::middleware(['auth:api', 'roles:Fournisseur'])->prefix('fournisseurs')->group(function () {
    Route::get('articles', 'ArticleController@getOfFournisseur');
    Route::post('articles', 'ArticleController@createOrUpdate');
});

/*****************************************************************************/
Route::middleware(['auth:api', 'roles:Fournisseur|Client'])->group(function () {
    Route::post('/commandes', 'CommandesController@pushPanier');
    //Route::get('/commandes', '');
    //Route::get('/commandes/{id}', '')->where('id','');
    Route::post('/commandes/{id}/payment', 'CommandesController@payment')->where('id', '[0-9]+');
});
/*****************************************************************************/
Route::middleware(['auth:api', 'roles:Admin'])->prefix('clients')->group(function () {
    Route::get('/', 'UsersController@index');

});

/*****************************************************************************/

/*****************************************************************************/

Route::get('categories', 'CategoriesController@index');

Route::get('articles', 'ArticleController@index');

/****route currentUser****/

//Route::post('/currentUser', 'UsersController@getCurrentUserDB');

/****route currentUser****/

//Route::get('Fruits', 'FruitsController@index');

//Route::get('users', 'UsersController@index');
