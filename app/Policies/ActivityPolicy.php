<?php

namespace App\Policies;

#use Illuminate\Auth\Access\Response;
use App\Models\Activity;
use App\Models\User;

class ActivityPolicy
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
     * @param \App\Models\Activity $activity
     *
     * @return bool
     */
    public function view(?User $user, Activity $activity): bool
    {
        return !is_null($user) || $activity->log_name != 'users';
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
        return false;
    }

   /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Activity $activity
     *
     * @return bool
     */
    public function update(User $user, Activity $activity): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Activity $activity
     *
     * @return bool
     */
    public function delete(User $user, Activity $activity): bool
    {
        return $user->is_admin && $user->tokenCan('activity:delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Activity $activity
     *
     * @return bool
     */
    public function restore(User $user, Activity $activity): bool
    {
        return $user->is_admin && $user->tokenCan('activity:restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Activity $activity
     *
     * @return bool
     */
    public function forceDelete(User $user, Activity $activity): bool
    {
        return false;
    }
}
