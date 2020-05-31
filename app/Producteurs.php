<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producteurs extends Model
{
    protected $table = "producteur";
    protected $fillable = ['id','name','id_users'];
    public $timestamps = false;

    function produit()
    {
        return $this->hasMany(Produits::class, 'id_producteur');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
