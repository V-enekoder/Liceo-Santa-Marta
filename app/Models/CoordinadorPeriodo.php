<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoordinadorPeriodo extends Model
{
    use HasFactory;

    protected $table = 'coordinador_periodo';
    public $timestamps = false;
    protected $fillable = [
        'coordinador_id',
        'periodo_id',
    ];

    // Relaciones Muchos-Uno

    public function coordinador(){
        return $this->belongsTo(Coordinador::class);
    }

    public function periodo(){
        return $this->belongsTo(Periodo_Academico::class);
    }

}
