<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const COORDINADOR = 1;
    const DOCENTE = 2;
    const REPRESENTANTE = 3;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //protected $primaryKey = 'cedula'; // Define la clave primaria

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'email',
        'direccion',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function telefonos(){
        return $this->hasMany(Telefono::class, 'user_cedula','cedula');
    }

    public function coordinador(){
        return $this->hasOne(Coordinador::class,'user_cedula','cedula');
    }
    public function docente(){
        return $this->hasOne(Docente::class,'user_cedula','cedula');
    }
    public function representante(){
        return $this->hasOne(Representante::class,'user_cedula','cedula');
    }

}
