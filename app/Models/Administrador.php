<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;
        use HasFactory;
    protected $table = 'administradores';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
    ];

    //Relaciones Uno-Uno

    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
