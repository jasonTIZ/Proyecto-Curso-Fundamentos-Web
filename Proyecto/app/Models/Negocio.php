<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $table = 'negocio';
    protected $primaryKey = 'id_negocio';
    public $timestamps = false;

    protected $fillable = [
        'nombre_negocio', 'descripcion', 'provincia', 'canton', 'distrito', 'barrio', 'otras_senas', 'telefono', 'email', 'facebook_url', 'instagram_url', 'tiktok_url', 'iframe_ubicacion'
    ];

    public function categorias()
    {
        return $this->belongsToMany(CategoriaNegocio::class, 'negocio_categoria_rel', 'id_negocio', 'id_categoria_negocio')->withPivot('id_rel');
    }

    public function imagenes()
    {
        return $this->hasMany(NegocioImagen::class, 'id_negocio', 'id_negocio');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_negocio', 'id_negocio');
    }
}
