<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $table = 'horario';
    protected $primaryKey = 'id_horario';
    public $timestamps = false;

    protected $fillable = [
        'id_doctor',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'disponible',
        'motivo_bloqueo',
        'tipus_bloqueig',
        'fecha_dato',
        'fecha_carga'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }
}
