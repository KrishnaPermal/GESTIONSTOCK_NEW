<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    protected $table = 'fruit';
    protected $fillable = ['id','nom'];
    public $timestamps = false;

    
    function users()
    {
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    }
}
