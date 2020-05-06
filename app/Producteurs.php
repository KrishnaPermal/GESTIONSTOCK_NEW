<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producteurs extends Model
{
    protected $table = "producteur";
    protected $fillable = ['id','name'];
    public $timestamps = false;

    function produit()
    {
        return $this->hasMany(Produits::class, 'id_producteur');
    }
}
