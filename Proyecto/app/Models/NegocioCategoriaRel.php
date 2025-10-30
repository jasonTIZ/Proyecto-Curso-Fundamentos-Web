<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NegocioCategoriaRel extends Model
{
    protected $table = 'negocio_categoria_rel';
    protected $primaryKey = 'id_rel';
    public $timestamps = false;

    protected $fillable = [
        'id_negocio', 'id_categoria_negocio'
    ];
}
