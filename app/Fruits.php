<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruits extends Model
{
    protected $table = 'fruit';
    protected $fillable = ['id','name'];
    public $timestamps = false;

    
    function produits()
    {
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    }
}
