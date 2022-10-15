<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(?User $user, User $empleado)
    {

    }

    public function create(User $user)
    {
        if($user->can('users_create')){
            return true;
        }
    }
}
