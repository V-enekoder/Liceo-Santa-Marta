<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;
    protected $table = 'representantes';
    protected $fillable = [
        'Nombre',
        'Apellido',
        'Direccion',
    ]; 

    //Relacion Mucho-Mucho

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_representante');
    }
}
