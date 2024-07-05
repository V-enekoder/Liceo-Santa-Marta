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

    public function grado(){
        return $this->belongsTo(Grado::class);
    }

    //Relación Mucho-Mucho

    public function docentes(){
        return $this->belongsToMany(Docente::class, 'materia_docente')
            ->withPivot('periodo_id');
    }

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_materia')
            ->withPivot('periodo_id');
    }
}
