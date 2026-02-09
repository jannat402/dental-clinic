<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id_post';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'contenido',
        'fecha_publicacion',
        'autor_id',
        'id_tratamiento',
        'enlace_cita',
        'fecha_dato',
        'fecha_carga'
    ];

    public function autor()
    {
        return $this->belongsTo(Administrativo::class, 'autor_id');
    }

    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'id_tratamiento');
    }
}
