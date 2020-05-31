<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    protected $table = "produit";
    protected $fillable = ['name','quantity','price','photo', 'id_producteur'];
    public $timestamps = false;

    function producteur()
    {
        return $this->belongsTo(Producteurs::class, 'id_producteur');
    }

    function recompenses()
    {
        return $this->belongsToMany('App\Recompenses', 'produit_has_recompense', 'id_produit', 'id_recompense');
    }
    function fruits()
    {
        return $this->belongsToMany('App\Fruits', 'produit_has_fruit', 'id_produit', 'id_fruit');
    }
    function user()
    {
        return $this->belongsToMany('App\User', 'users_has_commande', 'id_users', 'id_commande');
    }
}
