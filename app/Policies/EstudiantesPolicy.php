<?php

namespace App\Policies;

use App\Models\Estudiantes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstudiantesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole('Admin');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Estudiantes $estudiantes)
    {
        // return $user->hasAnyRole(['Admin', 'Estudiantes']);
        return $user->hasAnyRole('Admin');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole(['Admin', 'Estudiantes']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Estudiantes $estudiantes)
    {
        return $user->hasAnyRole(['Admin', 'Estudiantes']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Estudiantes $estudiantes)
    {
        return $user->hasAnyRole('Admin');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Estudiantes $estudiantes)
    {
        return $user->hasAnyRole(['Admin', 'Estudiantes']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Estudiantes  $estudiantes
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Estudiantes $estudiantes)
    {
        return $user->hasAnyRole('Admin');
    }
}
