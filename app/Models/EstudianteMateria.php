<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteMateria extends Model{
    use HasFactory;

    protected $table = 'estudiante_materia';

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }

    public function materia(){
        return $this->belongsTo(Materia::class);
    }

    public function periodo(){
        return $this->belongsTo(Periodo_Academico::class);
    }

    public function calificaciones(){
        return $this->hasMany(Calificacion::class);
    }
}
