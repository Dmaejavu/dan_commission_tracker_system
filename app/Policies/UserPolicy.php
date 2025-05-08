<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if the given user can edit another user.
     *
     * @param  \App\Models\User  $authUser
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $authUser, User $user)
    {
        return $authUser->position === 'Owner' || $authUser->position === 'Admin';
    }

    /**
     * Determine if the given user can update another user.
     *
     * @param  \App\Models\User  $authUser
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function update(User $authUser, User $user)
    {
        return $authUser->position === 'Owner' || $authUser->position === 'Admin';
    }
}
