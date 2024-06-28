<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo_Academico extends Model
{
    use HasFactory;
    protected $table = 'periodo_academicos';
    protected $fillable=[
        'Nombre',
        'Fecha_inicio',
        'Fecha_fin'
    ]; 
    
    //Relación Uno-Mucho
    
    public function calificaciones(): HasMany{
        return $this->hasMany(Calificacion::class);
    }    
    
        //Relación Mucho-Mucho

    public function coordinadores(){
        return $this->belongsToMany(Coordinador::class, 'coordinador_periodo');
    }

    public function docentes(){
        return $this->belongsToMany(Docente::class, 'docente_periodo');
    }

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_periodo');
    }

    public function grados(){
        return $this->belongsToMany(Grado::class, 'grado_periodo');
    }

    public function materias(){
        return $this->belongsToMany(Materia::class, 'materia_periodo');
    }

    public function secciones(){
        return $this->belongsToMany(Seccion::class, 'periodo_seccion');
    }       
}
