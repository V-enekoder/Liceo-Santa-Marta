<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{
    use HasFactory;
    protected $table = 'secciones';
    protected $fillable = [
        'Nombre',
    ];

    //Relación Mucho-Mucho

    public function grados(){
        return $this->belongsToMany(Grado::class,'grado_seccion')
            ->withPivot('periodo_id','estudiante_cedula');
    }
}
