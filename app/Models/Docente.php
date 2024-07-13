<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docentes';
    public $timestamps = false;
    protected $fillable = ['user_id'];
    
    //Relaciones Uno-Uno
    public function usuario(){
        return $this->belongsTo(User::class);
    }
    //Relaciones Muchos-Muchos
    
    public function materias(){
        return $this->belongsToMany(Materia::class, 'docente_materia')
            ->withPivot('periodo_id');
    }
}
