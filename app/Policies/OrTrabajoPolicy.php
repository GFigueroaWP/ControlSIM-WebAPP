<?php

namespace App\Policies;

use App\Models\OrTrabajo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrTrabajoPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrTrabajo  $orTrabajo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, OrTrabajo $orTrabajo)
    {
        if($user->hasRole(['Administrativo','super-admin'])){
            return true;
        }elseif($user->hasRole('Técnico') && $orTrabajo->tecnicos){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if($user->hasRole(['Administrativo','super-admin'])){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrTrabajo  $orTrabajo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, OrTrabajo $orTrabajo)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrTrabajo  $orTrabajo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, OrTrabajo $orTrabajo)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrTrabajo  $orTrabajo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, OrTrabajo $orTrabajo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\OrTrabajo  $orTrabajo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, OrTrabajo $orTrabajo)
    {
        //
    }
}
