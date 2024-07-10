<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $table = 'estudiantes';
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

    //Relaciones Muchos-Muchos

    public function materias(){
        return $this->belongsToMany(Materia::class, 'estudiante_materia')
            ->withPivot('periodo_id');
    }

    public function representantes(){
        return $this->belongsToMany(Representante::class, 'estudiante_representante')
            ->withPivot('periodo_id');
    }
    public function secciones(){
        return $this->belongsToMany(Seccion::class, 'estudiante_seccion');
    }
}
