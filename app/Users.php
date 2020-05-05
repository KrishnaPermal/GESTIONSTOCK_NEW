<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Users::class, 'id_role');
    }
    function users()
    {
        return $this->belongsToMany('App\Users', 'users_has_commande', 'id_users', 'id_commande');
    }
}
