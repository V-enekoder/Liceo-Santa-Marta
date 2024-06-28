<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docentes';
    protected $fillable = [
        'Cedula',
        'Nombre',
        'Apellido',
        'Telefono',
        'Direccion',
        'Usuario',
        'Clave',
    ];

    //Relacion Uno-Mucho

    public function calificaciones(): BelongsTo{
        return $this->belongsTo(Calificacion::class);
    }

    //Relación Mucho-Mucho
    
    public function materias(){
        return $this->belongsToMany(Materia::class, 'materia_docente');
    }

    public function periodo_academicos(){
        return $this->belongsToMany(Periodo_Academico::class, 'docente_periodo');
    }
}
