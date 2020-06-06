<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categorie';
    protected $fillable = ['id','name'];
    public $timestamps = false;

    function users()
    {
        return $this->belongsToMany('App\User', 'users_has_commande', 'id_users', 'id_commande');
    }

    function article()
    {
        return $this->belongsToMany('App\Articles', 'article_has_categorie', 'id_article', 'id_categorie');
    }


}
