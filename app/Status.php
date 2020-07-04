<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = "status";
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
    function commandes()
    {
        return $this->hasMany(Commandes::class, 'id_status');
    }
}
