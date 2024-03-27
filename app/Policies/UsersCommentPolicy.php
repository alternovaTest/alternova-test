<?php

namespace App\Policies;

use App\Models\User;

class UsersCommentPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if($user->hasPermissionTo('comment-items')){
            return true;
        }

        return false;
    }
}
