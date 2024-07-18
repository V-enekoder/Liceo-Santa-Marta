<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;
    protected $table = 'representantes';
    public $timestamps = false;
    protected $fillable = ['user_id']; 

    //Relaciones Uno-Uno
    public function user(){
        return $this->belongsTo(User::class);
    }
    //Relaciones Muchos-Muchos

    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'estudiante_representante')
            ->withPivot('periodo_id');
    }

}