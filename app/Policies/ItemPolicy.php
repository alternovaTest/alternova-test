<?php

namespace App\Policies;

use App\Models\User;

class ItemPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function Create(User $user): bool
    {
        if($user->hasPermissionTo('create-items')){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function Update(User $user): bool
    {
        if($user->hasPermissionTo('update-items')){
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function Delete(User $user): bool
    {
        if($user->hasPermissionTo('delete-items')){
            return true;
        }

        return false;
    }

    public function filterByType(User $user): bool
    {
        if($user->hasPermissionTo('filter-items')){
            return true;
        }

        return false;
    }

    public function sortAlphabetically(User $user): bool
    {
        if($user->hasPermissionTo('sort-items')){
            return true;
        }

        return false;
    }
}
