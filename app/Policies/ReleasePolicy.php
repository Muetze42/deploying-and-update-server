<?php

namespace App\Policies;

use App\Models\Release;
use App\Models\User;

class ReleasePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User|null $user
     *
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\Release   $release
     *
     * @return bool
     */
    public function view(?User $user, Release $release): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->tokenCan('release:create');
    }

   /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Release $release
     *
     * @return bool
     */
    public function update(User $user, Release $release): bool
    {
        return $user->tokenCan('release:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Release $release
     *
     * @return bool
     */
    public function delete(User $user, Release $release): bool
    {
        return $user->tokenCan('release:delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Release $release
     *
     * @return bool
     */
    public function restore(User $user, Release $release): bool
    {
        return $user->tokenCan('release:restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User    $user
     * @param \App\Models\Release $release
     *
     * @return bool
     */
    public function forceDelete(User $user, Release $release): bool
    {
        return $user->is_admin && $user->tokenCan('release:forceDelete');
    }
}
