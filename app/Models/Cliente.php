<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'contrasenya',
        'metodo_autenticacion',
        'fecha_dato',
        'fecha_carga',
    ];

    protected $hidden = [
        'contrasenya',
    ];

    // Para que Auth use 'contrasenya' como password
    public function getAuthPassword()
    {
        return $this->contrasenya;
    }

    // Relaciones
    public function historialClinico()
    {
        return $this->hasMany(HistorialClinico::class, 'id_cliente');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_cliente');
    }
}
