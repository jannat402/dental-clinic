<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditoria';
    protected $primaryKey = 'id_auditoria';
    public $timestamps = false;
    const CREATED_AT = 'created_at';

    protected $fillable = [
        'usuario_type',
        'usuario_id',
        'accio',
        'entitat_type',
        'entitat_id',
        'valors_anteriors',
        'valors_nous',
    ];

    protected function casts(): array
    {
        return [
            'valors_anteriors' => 'array',
            'valors_nous' => 'array',
        ];
    }

    public function usuari()
    {
        return $this->morphTo('usuario');
    }

    public function entitat()
    {
        return $this->morphTo();
    }
}
