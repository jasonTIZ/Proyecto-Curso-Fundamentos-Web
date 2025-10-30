<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioWebmaster extends Model
{
    protected $table = 'usuario_webmaster';
    protected $primaryKey = 'id_webmaster';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'apellido1', 'apellido2', 'email', 'telefono', 'contrasena'
    ];
}
