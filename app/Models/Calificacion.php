<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;
    protected $table = 'calificaciones'; 
    public $timestamps = false;
    protected $fillable = [
        'docente_materia_id',
        'estudiante_id',
        'lapso_1',
        'lapso_2',
        'lapso_3',
        'promedio',
    ];

    //Relaciones Muchos-Uno
    public function docente_materia(){
        return $this->belongsTo(DocenteMateria::class);
    }

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
}
