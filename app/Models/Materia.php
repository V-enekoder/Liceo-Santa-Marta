<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materias';
    public $timestamps = false;
    protected $fillable = [
        'grado_id',
        'nombre', 
    ];

    //Relaciones Muchos-Uno
    public function grado(){
        return $this->belongsTo(Grado::class);
    }
    
    //Relaciones Muchos-Muchos
    public function docentes(){
        return $this->belongsToMany(Docente::class, 'materia_docente')
            ->withPivot('periodo_id');
    }
}
