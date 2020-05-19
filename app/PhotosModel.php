<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotosModel extends Model
{
    protected $table = "photos";
    protected $fillable = ['id','photo'];
    public $timestamps = false;

    function produit()
    {
        return $this->hasMany('App\Photos', 'id_photo');
    }
}
