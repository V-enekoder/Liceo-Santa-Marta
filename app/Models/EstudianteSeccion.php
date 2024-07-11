<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteSeccion extends Model
{
    use HasFactory;

//Relaciones Muchos-Uno

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }

    public function seccion(){
        return $this->belongsTo(Seccion::class);
    }
}
