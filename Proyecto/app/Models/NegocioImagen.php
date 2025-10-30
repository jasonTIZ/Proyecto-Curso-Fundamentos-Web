<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NegocioImagen extends Model
{
    protected $table = 'negocio_imagen';
    protected $primaryKey = 'id_imagen_negocio';
    public $timestamps = false;

    protected $fillable = [
        'id_negocio', 'url_imagen'
    ];
}
