<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->tokenCan('user:viewAny');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return $user->tokenCan('user:view');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User|null $user
     *
     * @return bool
     */
    public function create(?User $user): bool
    {
        return $user->is_admin && $user->tokenCan('user:create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return ($user->is_admin || $user->getKey() == $model->getKey()) && $user->tokenCan('user:update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function delete(?User $user, User $model): bool
    {
        return $user->is_admin && $user->tokenCan('user:delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function restore(?User $user, User $model): bool
    {
        return $user->is_admin && $user->tokenCan('user:restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User|null $user
     * @param \App\Models\User $model
     *
     * @return bool
     */
    public function forceDelete(?User $user, User $model): bool
    {
        return $user->is_admin && $user->tokenCan('user:forceDelete');
    }
}
