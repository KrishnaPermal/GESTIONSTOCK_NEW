<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    protected $table = "commande";
    public $timestamps = false;
    
    function article()
    {
        return $this->belongsToMany('App\Articles', 'commande_has_article', 'id_commande','id_article');
    }
    function users()
    {
        return $this->belongsTo(User::class,'id_users');
    }

    function adresseLivraison()
    {
        return $this->belongsTo(Adresses::class, 'id_adresse_livraison');
    }
    function adresseFacturation()
    {
        return $this->belongsTo(Adresses::class, 'id_adresse_facturation');
    }
    function commandeStatus()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
