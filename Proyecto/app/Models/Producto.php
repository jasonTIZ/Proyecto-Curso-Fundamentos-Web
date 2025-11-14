<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre_producto', 'id_categoria', 'id_negocio', 'precio', 'descripcion'
    ];

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class, 'id_producto', 'id_producto');
    }

    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio', 'id_negocio');
    }

    public function categoria()
    {
        return $this->belongsTo(CategoriaProducto::class, 'id_categoria', 'id_categoria');
    }
}
