<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctor';
    protected $primaryKey = 'id_doctor';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'especialidad',
        'estado',
        'fecha_dato',
        'fecha_carga'
    ];

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
}
