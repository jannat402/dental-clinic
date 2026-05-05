<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrativo extends Authenticatable
{
    protected $table = 'administrativo';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'contrasenya',
        'autenticacion_segura',
        'rol',
        'fecha_dato',
        'fecha_carga',
    ];

    protected $hidden = [
        'contrasenya',
    ];

    public function getAuthPassword()
    {
        return $this->contrasenya;
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_admin');
    }

    public function posts()
    {
        return $this->hasMany(Blog::class, 'autor_id');
    }
}
