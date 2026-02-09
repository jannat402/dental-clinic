<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';
    protected $primaryKey = 'id_pago';
    public $timestamps = false;

    protected $fillable = [
        'id_cita',
        'monto',
        'metodo_pago',
        'estado_pago',
        'fecha_pago',
        'fecha_dato',
        'fecha_carga'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}
