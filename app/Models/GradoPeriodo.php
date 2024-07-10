<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradoPeriodo extends Model{
    use HasFactory;


    public function grado(){
        return $this->belongsTo(Grado::class);
    }

    public function periodo(){
        return $this->belongsTo(Periodo_Academico::class);
    }

    public function secciones(){
        return $this->hasMany(Seccion::class);
    }

}
