<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    protected $table = 'grados';
    protected $fillable = [
        'Año',
    ];

    //Relacion Uno-Mucho

    public function materias(): BelongsTo{
        return $this->belongsTo(Materia::class);
    }

    public function secciones(): BelongsTo{
        return $this->belongsTo(Seccion::class);
    }

    //Relación Mucho-Mucho

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_grado');
    }

    public function periodo_academicos(){
        return $this->belongsToMany(Periodo_Academico::class, 'grado_periodo');
    }
}
