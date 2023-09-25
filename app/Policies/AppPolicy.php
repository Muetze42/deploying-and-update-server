<?php

namespace App\Policies;

use App\Models\App;
use App\Models\User;

class AppPolicy
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
     * @param \App\Models\App       $application
     *
     * @return bool
     */
    public function view(?User $user, App $application): bool
    {
        return !is_null($user) || $application->active;
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
        return $user->tokenCan('application:create');
    }

   /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\App  $application
     *
     * @return bool
     */
    public function update(User $user, App $application): bool
    {
        return $user->tokenCan('application:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\App  $application
     *
     * @return bool
     */
    public function delete(User $user, App $application): bool
    {
        return $user->tokenCan('application:delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\App  $application
     *
     * @return bool
     */
    public function restore(User $user, App $application): bool
    {
        return $user->tokenCan('application:restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\App  $application
     *
     * @return bool
     */
    public function forceDelete(User $user, App $application): bool
    {
        return $user->tokenCan('application:forceDelete');
    }
}
