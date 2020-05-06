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
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    }
}
