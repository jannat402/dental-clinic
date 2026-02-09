<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    protected $table = 'administrativo';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'autenticacion_segura',
        'rol',
        'fecha_dato',
        'fecha_carga'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_admin');
    }

    public function posts()
    {
        return $this->hasMany(Blog::class, 'autor_id');
    }
}
