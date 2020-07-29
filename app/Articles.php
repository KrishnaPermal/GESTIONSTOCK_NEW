<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model
{

    protected $table = "article";
    protected $fillable = ['article_ref','mark','description','provider','photo' ,'quantity','price', 'id_fournisseur', 'id_categorie'];
    public $timestamps = false;

    function fournisseur()
    {
        return $this->belongsTo(Fournisseurs::class, 'id_fournisseur');
    }

    function categories()
    {
        return $this->belongsTo(Categories::class,'id_categorie');
    }
    function user()
    {
        return $this->belongsToMany('App\User', 'users_has_commande', 'id_users', 'id_commande');
    }
    function commandes()
    {
        return $this->belongsToMany(Articles::class, 'commande_has_order', 'id_commande', 'id_article');
    }
    
}
