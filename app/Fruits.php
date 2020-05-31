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
        return $this->belongsToMany('App\User', 'users_has_commande', 'id_users', 'id_commande');
    }

    function produit()
    {
        return $this->belongsToMany('App\Produits', 'produit_has_fruit', 'id_produit', 'id_fruit');
    }


}
