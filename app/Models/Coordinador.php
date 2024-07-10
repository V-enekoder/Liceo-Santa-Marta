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
        'user_id',
        'fecha_ingreso',
        'fecha_retiro',
    ];

    //Relaciones Muchos a Muchos

    public function periodo_academicos(){
        return $this->belongsToMany(Periodo_Academico::class, 'coordinador_periodo');
    }

    public function usuario(){
        return $this->belongsTo(User::class);
    }

    
}
