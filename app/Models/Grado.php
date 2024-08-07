<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    protected $table = 'grados';
    public $timestamps = false;
    protected $fillable = [
        'nombre_grado',
    ];
    //Relaciones Uno-Muchos
    public function materias(){
        return $this->hasMany(Materia::class);
    }
    //Relaciones Muchos-Muchos

    public function periodos(){
        return $this->belongsToMany(Periodo_Academico::class,'GradoPeriodo');
    }
}
