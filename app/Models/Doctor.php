<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $table = 'doctor';
    protected $primaryKey = 'id_doctor';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'contrasenya',
        'especialidad',
        'estado',
        'doble_factor',
        'user_id',
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

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_doctor');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_doctor');
    }

    public function historiales()
    {
        return $this->belongsToMany(HistorialClinico::class, 'doctor_historial', 'id_doctor', 'id_historial');
    }

    public function tratamientos()
    {
        return $this->belongsToMany(Tratamiento::class, 'doctor_tratamiento', 'id_doctor', 'id_tratamiento');
    }
}
