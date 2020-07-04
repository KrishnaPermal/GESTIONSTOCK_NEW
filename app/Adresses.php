<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresses extends Model
{
    protected $table = 'adresses';
    protected $fillable = ['id','name','firstname','country','address','city','postal_code','phone','id_users'];
    public $timestamps = false;


    function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
