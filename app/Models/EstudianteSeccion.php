<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteSeccion extends Model
{
    use HasFactory;

    protected $table = 'estudiante_seccion';

    public $timestamps = false;
    protected $fillable =[
        'estudiante_id',
        'seccion_id',
    ];
//Relaciones Muchos-Uno

    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }

    public function seccion(){
        return $this->belongsTo(Seccion::class);
    }
}
