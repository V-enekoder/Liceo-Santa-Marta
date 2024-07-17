<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'personas';
    public $timestamps = false;
    protected $fillable = [
        'categoria_id',
        'cedula',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'direccion',
        'fecha_nacimiento',
        'activo'
    ];

    //Relacion Uno-Uno
    public function user(){
        return $this->hasOne(User::class);
    }

    //Relacion Mucho-Uno
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function estudiante(){
        return $this->hasOne(Estudiante::class);
    }
}
