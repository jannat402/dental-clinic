<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $table = 'cita';
    protected $primaryKey = 'id_cita';
    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'id_doctor',
        'id_tratamiento',
        'id_admin',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'estado',
        'tipo_reserva',
        'fecha_dato',
        'fecha_carga'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'id_tratamiento');
    }

    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class, 'id_admin');
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_cita');
    }
}
