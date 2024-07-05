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

    public function materias(){
        return $this->hasMany(Materia::class);
    }

    public function secciones(){
        return $this->belongsToMany(Seccion::class,'grado_seccion')
            ->withPivot('periodo_id','estudiante_cedula');
    }
}
