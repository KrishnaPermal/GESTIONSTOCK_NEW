<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = "article";
    protected $fillable = ['article_ref','mark','description','provider','photo' ,'quantity','price', 'id_fournisseur'];
    public $timestamps = false;

    function fournisseur()
    {
        return $this->belongsTo(Fournisseurs::class, 'id_fournisseur');
    }

    function categories()
    {
        return $this->belongsToMany('App\Categories', 'article_has_categorie', 'id_article', 'id_categorie');
    }
    function user()
    {
        return $this->belongsToMany('App\User', 'users_has_commande', 'id_users', 'id_commande');
    }
}
