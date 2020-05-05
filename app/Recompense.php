<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recompense extends Model
{
    protected $table = "recompense";
    protected $fillable = ['name','annee'];
    public $timestamps = false;

    function users()
    {
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    }
}
