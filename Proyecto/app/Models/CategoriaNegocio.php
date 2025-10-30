<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaNegocio extends Model
{
    protected $table = 'categoria_negocio';
    protected $primaryKey = 'id_categoria_negocio';
    public $timestamps = false;

    protected $fillable = [
        'nombre_categoria', 'descripcion'
    ];

    public function negocios()
    {
        return $this->belongsToMany(Negocio::class, 'negocio_categoria_rel', 'id_categoria_negocio', 'id_negocio');
    }
}
