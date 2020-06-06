<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseurs extends Model
{
    protected $table = "fournisseur";
    protected $fillable = ['id','name','firstname','phone','email','address','id_users'];
    public $timestamps = false;

    function article()
    {
        return $this->hasMany(Articles::class, 'id_fournisseur');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
