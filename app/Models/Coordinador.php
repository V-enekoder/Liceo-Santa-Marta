<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    use HasFactory;
    protected $table = 'coordinadores';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'fecha_ingreso',
        'fecha_retiro',
    ];

    //Relaciones Uno-Uno

    
    public function usuario(){
        return $this->belongsTo(User::class);
    }
    //Relaciones Muchos-Muchos
    public function periodo_academicos(){
        return $this->belongsToMany(Periodo_Academico::class, 'coordinador_periodo');
    }

    
}
