<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;
    protected $table = 'calificaciones';
    protected $fillable = [
        'lapso_1',
        'lapso_2',
        'lapso_3',
    ];

    //Relacion Uno-Mucho

    public function docentes(): BelongsTo{
        return $this->belongsTo(Docente::class);
    }

    public function estudiantes(): BelongsTo{
        return $this->belongsTo(Estudiante::class);
    }

    public function materias(): BelongsTo{
        return $this->belongsTo(Materia::class);
    }

    public function periodo_academicos(): BelongsTo{
        return $this->belongsTo(Periodo_Academico::class);
    }
}
