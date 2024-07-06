<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradoSeccion extends Model{
    use HasFactory;
    protected $table = 'grado_seccion';
    public function grado(){
        return $this->belongsTo(Grado::class);
    }

    public function seccion(){
        return $this->belongsTo(Seccion::class);
    }

    public function periodo(){
        return $this->belongsTo(Periodo_Academico::class);
    }
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
}
