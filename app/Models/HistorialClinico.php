<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialClinico extends Model
{
    protected $table = 'historial_clinico';
    protected $primaryKey = 'id_historial';
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'notas_diagnostico',
        'documentos_adjuntos',
        'fecha_ultima_actualizacion',
        'fecha_dato',
        'fecha_carga'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function doctores()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_historial', 'id_historial', 'id_doctor');
    }
}
