<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo_Academico extends Model
{
    use HasFactory;
    protected $fillable=[
        'Nombre',
        'Fecha_inicio',
        'Fecha_fin'];
}
