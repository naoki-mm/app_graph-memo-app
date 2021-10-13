<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $login_user
     * @param  \App\User  $request_user
     * @return bool
     */
    public function update(User $login_user, User $request_user)
    {
        return $login_user->id === $request_user->id;
    }
}
