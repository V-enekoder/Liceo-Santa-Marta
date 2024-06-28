<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $fillable = [
        'Nombre',
    ];

    //Relacion Uno-Mucho

    public function grados(): BelongsTo{
        return $this->belongsTo(Grado::class);
    }

    //Relación Mucho-Mucho

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_seccion');
    }
    
    public function periodo_academicos(){
        return $this->belongsToMany(Periodo_Academico::class, 'periodo_seccion');
    }   
}
