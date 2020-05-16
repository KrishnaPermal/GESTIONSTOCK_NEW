<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "role";
    protected $fillable = ['id','name'];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
        //return $this->belongsToMany(Users::class, 'id_role');
    }
}
