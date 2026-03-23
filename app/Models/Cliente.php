<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
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
        'fecha_carga'
    ];

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
