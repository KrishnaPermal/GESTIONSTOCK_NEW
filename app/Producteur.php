<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producteur extends Model
{
    protected $table = "producteur";
    protected $fillable = ['id','nom'];
    public $timestamps = false;

    function produits()
    {
        return $this->hasMany(Produit::class, 'id_producer');
    }
}
