<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{

    public $timestamps = false;


    use HasFactory;
    protected $table = 'coordinadores';
    protected $fillable = [
        'Cedula',
        'Nombre',
        'Apellido',
        'Telefono',
        'Direccion',
        'Usuario',
        'Clave',
        'Fecha_ingreso',
        'Fecha_retiro',
    ];

    //Relaciones Muchos a Muchos

    public function periodo_academicos(){
        return $this->belongsToMany(Periodo_Academico::class, 'coordinador_periodo');
    }

    public function usuario(){
        return $this->belongsTo(User::class,'user_cedula','cedula');
    }

    
}
