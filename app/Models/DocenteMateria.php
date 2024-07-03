<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteMateria extends Model
{
    use HasFactory;

    protected $table = 'docente_materia';

    protected $fillable = ['docente_id', 'materia_id', 'periodo_id'];

    public function docente(){
        return $this->belongsTo(Docente::class);
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