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
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'ultimo_grado_aprobado',
    ];

    //Relacion Uno-Mucho

    //Relacion Mucho-Mucho

    public function materias(){
        return $this->belongsToMany(Materia::class, 'estudiante_materia')
            ->withPivot('periodo_id');
    }

    public function representantes(){
        return $this->belongsToMany(Representante::class, 'estudiante_representante')
            ->withPivot('periodo_id');
    }
    
    public function grado_seccion(){
        return $this->hasMany(GradoSeccion::class);
    }
}
