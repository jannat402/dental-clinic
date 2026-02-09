<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorHistorial extends Model
{
    protected $table = 'doctor_historial';
    protected $primaryKey = 'id_doctor_historial';
    public $timestamps = false;

    protected $fillable = [
        'id_doctor',
        'id_historial',
        'fecha_asignacion',
        'fecha_dato',
        'fecha_carga'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }

    public function historial()
    {
        return $this->belongsTo(HistorialClinico::class, 'id_historial');
    }
}
