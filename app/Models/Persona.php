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
        'cedula',
        'fecha_nacimiento'
    ];

    //Relacion Uno-Uno
    public function user(){
        return $this->hasOne(User::class);
    }

    public function estudiante(){
        return $this->hasOne(Estudiante::class);
    }
}
