<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use HasFactory;
    protected $table = 'tratamiento';
    protected $primaryKey = 'id_tratamiento';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tratamiento',
        'duracion_minutos',
        'precio',
        'descripcion',
        'fecha_dato',
        'fecha_carga'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_tratamiento');
    }

    public function posts()
    {
        return $this->hasMany(Blog::class, 'id_tratamiento');
    }
}
