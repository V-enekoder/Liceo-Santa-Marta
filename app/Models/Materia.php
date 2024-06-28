<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materias';
    protected $fillable = [
        'Nombre', 
    ];

    //Relacion Uno-Mucho

    public function calificaciones(): BelongsTo{
        return $this->belongsTo(Calificacion::class);
    }

    public function grados(): BelongsTo{
        return $this->belongsTo(Grado::class);
    }

    //Relación Mucho-Mucho

    public function docentes(){
        return $this->belongsToMany(Docente::class, 'materia_docente');
    }

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_materia');
    }

    public function periodo_academicos(){
        return $this->belongsToMany(Periodo_Academico::class, 'materia_periodo');
    }
}
