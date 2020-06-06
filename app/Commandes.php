<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    protected $table = "commande";
    public $timestamps = false;
    
    function article()
    {
        return $this->belongsToMany('App\Articles', 'commande_has_article', 'id_commande','id_article');
    }
    function users()
    {
        return $this->belongsToMany('App\User', 'users_has_commande', 'id_users', 'id_commande');
    }
}
