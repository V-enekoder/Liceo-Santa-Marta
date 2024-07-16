<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;
    protected $table = 'telefonos';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'numero_telefonico',
    ];
    //Relaciones Muchos-Uno
    public function user(){
        return $this->belongsTo(User::class);
    }
}

