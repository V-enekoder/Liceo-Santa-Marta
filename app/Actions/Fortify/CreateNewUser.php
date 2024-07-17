<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Persona;
use App\Models\Representante;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\ValidationException;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validar los datos de entrada
        Validator::make($input, [
            'cedula' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Comprobar si la cédula existe en la tabla personas
        $persona = Persona::where('cedula', $input['cedula'])->first();

        if (!$persona) {
            throw ValidationException::withMessages([
                'cedula' => ['La cédula no se encuentra registrada en la base de datos.'],
            ]);
        }

        // Buscar el usuario asociado a esta persona
        $user = $persona->user;

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['No se encontró un usuario asociado a esta persona.'],
            ]);
        }
    
        if ($user->rol_id != 4) {
            throw ValidationException::withMessages([
                'rol_id' => ['El usuario no tiene permisos para realizar esta acción. Comuníquese con la institucion.'],
            ]);
        }
        // Actualizar los campos proporcionados
        $user->email = $input['email'];
        if (isset($input['password'])) {
            $user->password = Hash::make($input['password']);
        }

        $user->save();

        return $user;
    }
}
