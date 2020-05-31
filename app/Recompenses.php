<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recompenses extends Model
{
    protected $table = "recompense";
    protected $fillable = ['name','year'];
    public $timestamps = false;

    function users()
    {
        return $this->belongsToMany('App\User', 'users_has_commande', 'id_users', 'id_commande');
    }

    function recompenses()
    {
        return $this->belongsToMany('App\Recompenses', 'produit_has_recompense', 'id_produit', 'id_recompense');
    }
}
