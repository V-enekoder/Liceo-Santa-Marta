<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $fillable = [
        'grado_periodo_id',
        'nombre',
        'alumnos_inscritos',
        'capacidad'
    ];

    //Relaciones Muchos-Uno
    public function grado_periodo(){
        return $this->belongsTo(GradoPeriodo::class);
    }
    //Relaciones Muchos-Muchos
    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_seccion');
    }
}
