<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UsuarioWebmaster extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario_webmaster';
    protected $primaryKey = 'id_webmaster';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'apellido1', 'apellido2', 'email', 'telefono', 'contrasena'
    ];

    protected $hidden = [
        'contrasena',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
