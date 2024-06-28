<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $table = 'estudiantes';
    protected $fillable = [
        'Cedula',
        'Nombre',
        'Apellido',
        'Fecha_Nacimiento',
    ];

    //Relacion Uno-Mucho

    public function calificaciones(): BelongsTo{
        return $this->belongsTo(Calificacion::class);
    }

    //Relacion Mucho-Mucho

    public function materias(){
        return $this->belongsToMany(Materia::class, 'estudiante_materia');
    }

    public function grados(){
        return $this->belongsToMany(Grado::class, 'estudiante_grado');
    }

    public function periodo_Academicos(){
        return $this->belongsToMany(Periodo_Academico::class, 'estudiante_periodo');
    }

    public function representantes(){
        return $this->belongsToMany(Representante::class, 'estudiante_representante');
    }

    public function secciones(){
        return $this->belongsToMany(Seccion::class, 'estudiante_seccion');
    }
}
