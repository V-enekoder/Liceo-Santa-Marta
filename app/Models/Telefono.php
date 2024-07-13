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
        'Telefono'
    ];
    //Relaciones Muchos-Uno
    public function representante(){
        return $this->belongsTo(User::class);
    }

}

