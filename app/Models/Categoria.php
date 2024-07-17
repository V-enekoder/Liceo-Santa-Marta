<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    public $timestamps = false;
    protected $fillable = ['nombre'];

    use HasFactory;

    //Relaciones Uno-Muchos
    public function personas(){
        return $this->hasMany(Persona::class);
    }
}
