<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteRepresentante extends Model{
    use HasFactory;
    protected $table = 'estudiante_representante';
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }

    public function representante(){
        return $this->belongsTo(Representante::class);
    }

    public function periodo(){
        return $this->belongsTo(Periodo_Academico::class);
    }
}
