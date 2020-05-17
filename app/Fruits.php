<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruits extends Model
{
    protected $table = 'fruit';
    protected $fillable = ['id','name'];
    public $timestamps = false;

    function users()
    {
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    }

    function fruits()
    {
        return $this->belongsToMany(Fruits::class, 'produit_has_fruit', 'id_produit', 'id_fruit');
    }


    /* function produits()
    {
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    } */

    /* function fruits()
    {
        return $this->belongsToMany('App\Fruits', 'produit_has_fruit', 'id_produit', 'id_fruit');
    } */
}
