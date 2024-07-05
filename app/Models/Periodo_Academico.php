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
    
        //Relación Mucho-Mucho

    public function coordinadores(){
        return $this->belongsToMany(Coordinador::class, 'coordinador_periodo');
    }

    public function docente_materia(){
        return $this->hasMany(DocenteMateria::class);
    }

    public function estudiante_materia(){
        return $this->hasMany(EstudianteMateria::class);
    }

    public function estudiante_representante(){
        return $this->hasMany(EstudianteRepresentante::class);
    }
    
    public function grado_seccion(){
        return $this->hasMany(GradoSeccion::class);
    }

}
