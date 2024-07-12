<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo_Academico extends Model
{
    use HasFactory;

    protected $table = 'periodos_academicos';
    public $timestamps = false;
    protected $fillable=[
        'nombre',
        'año_inicio',
        'año_fin'
    ]; 
    
    //Relaciones Uno-Muchos
    public function docente_materia(){
        return $this->hasMany(DocenteMateria::class);
    }

    public function estudiante_representante(){
        return $this->hasMany(EstudianteRepresentante::class);
    }
    
    //Relaciones Muchos-Muchos

    public function coordinadores(){
        return $this->belongsToMany(Coordinador::class, 'coordinador_periodo');
    }

    public function grados(){
        return $this->belongsToMany(Grado::class,'GradoPeriodo');
    }
}
