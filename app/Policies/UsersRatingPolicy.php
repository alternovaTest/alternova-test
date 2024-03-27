<?php

namespace App\Policies;

use App\Models\User;

class UsersRatingPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->hasPermissionTo('rating-items')){
            return true;
        }

        return false;
    }
}
