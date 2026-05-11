<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensajes';
    protected $primaryKey = 'id_mensaje';
    public $timestamps = false;
    const CREATED_AT = 'created_at';

    protected $fillable = [
        'remitente_type',
        'remitente_id',
        'destinatario_type',
        'destinatario_id',
        'asunto',
        'cuerpo',
        'leido',
    ];

    public function remitente()
    {
        return $this->morphTo();
    }

    public function destinatario()
    {
        return $this->morphTo();
    }
}
