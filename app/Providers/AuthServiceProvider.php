<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
        Gate::define('ver_boletin', fn (User $user) =>
            $user->rol_id == User::REPRESENTANTE
        );
        
        Gate::define('ver_ficha', fn (User $user) =>
            $user->rol_id == User::REPRESENTANTE
        );

        Gate::define('cargar_notas', fn (User $user) =>
            $user->rol_id == User::DOCENTE
        );

        Gate::define('ver_secciones', fn (User $user) => //Preguntar a mariana que hace
            $user->rol_id == User::DOCENTE
        );
        Gate::define('ver_carga_academica', fn (User $user) =>
            $user->rol_id == User::DOCENTE
        );

        Gate::define('crear_periodo', fn (User $user) =>
            $user->rol_id == User::COORDINADOR
        );
        Gate::define('modificar_notas', fn (User $user) =>
            $user->rol_id == User::COORDINADOR
        );
        Gate::define('modificar_representante', fn (User $user) =>
            $user->rol_id == User::COORDINADOR
        );
        Gate::define('modificar_estudiante', fn (User $user) =>
            $user->rol_id == User::COORDINADOR
        );
        Gate::define('modificar_materias', fn (User $user) =>
            $user->rol_id == User::COORDINADOR
        );
        Gate::define('modificar_docente', fn (User $user) =>
            $user->rol_id == User::COORDINADOR
        );

        Gate::define('asignar_carga_academica', fn (User $user) =>
            $user->rol_id == User::COORDINADOR
        );

        Gate::define('es_administrador', fn (User $user) =>
            $user->rol_id == User::ADMINISTRADOR
        );

        Gate::define('es_coordinador', fn (User $user) =>
            $user->rol_id == User::COORDINADOR
        );

            Gate::define('es_docente', fn (User $user) =>
        $user->rol_id == User::DOCENTE
        );

            Gate::define('es_representante', fn (User $user) =>
        $user->rol_id == User::REPRESENTANTE
        );
    }
}