<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $table = "produit";
    protected $fillable = ['name','quantity','saveur','prix','id_producteur'];
    public $timestamps = false;

    function producteurs()
    {
        return $this->belongsTo(Producteur::class, 'id_producer');
    }
    function recompenses()
    {
        return $this->belongsToMany('App\Recompense', 'produit_has_recompense', 'id_produit', 'id_recompense');
    }
    function fruits()
    {
        return $this->belongsToMany('App\Fruit', 'produit_has_fruit', 'id_produit', 'id_fruit');
    }
    function users()
    {
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    }
}
