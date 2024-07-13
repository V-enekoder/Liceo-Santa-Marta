<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $table = 'estudiantes';
    public $timestamps = false;

    protected $fillable = [
        'cedula',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'ultimo_grado_aprobado',
    ];

    protected $dates = [
        'fecha_nacimiento'
    ];
    //Relaciones Uno-Muchos
    public function calificaciones(){
        return $this->hasMany(Calificacion::class);
    }
    //Relaciones Muchos-Muchos
    public function representantes(){
        return $this->belongsToMany(Representante::class, 'estudiante_representante')
            ->withPivot('periodo_id');
    }
    public function secciones(){
        return $this->belongsToMany(Seccion::class, 'estudiante_seccion');
    }
}
