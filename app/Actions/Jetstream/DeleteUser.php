<?php

namespace App\Actions\Jetstream;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(Authenticatable $user): void
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
