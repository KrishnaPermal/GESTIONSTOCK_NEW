<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $table = "commande";
    public $timestamps = false;
    
    function produit()
    {
        return $this->belongsToMany('App\Produit', 'commande_has_produit', 'id_commande','id_produit');
    }
    function users()
    {
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    }
}
