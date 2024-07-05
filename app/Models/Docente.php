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

    //Relación Mucho-Mucho
    
    public function materias(){
        return $this->belongsToMany(Materia::class, 'docente_materia')
            ->withPivot('periodo_id');
    }

    public function usuario(){
        return $this->belongsTo(User::class,'user_cedula','cedula');
    }
}
