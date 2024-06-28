<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    use HasFactory;

    public function telefonos(){
        return $this->hasMany(Telefono::class, 'representante_id');
    }
}
