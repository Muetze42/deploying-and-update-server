<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VirusTotalAnalysis;

class VirusTotalAnalysisPolicy
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
     * @param \App\Models\User|null          $user
     * @param \App\Models\VirusTotalAnalysis $virusTotalAnalysis
     *
     * @return bool
     */
    public function view(?User $user, VirusTotalAnalysis $virusTotalAnalysis): bool
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
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User               $user
     * @param \App\Models\VirusTotalAnalysis $virusTotalAnalysis
     *
     * @return bool
     */
    public function update(User $user, VirusTotalAnalysis $virusTotalAnalysis): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User               $user
     * @param \App\Models\VirusTotalAnalysis $virusTotalAnalysis
     *
     * @return bool
     */
    public function delete(User $user, VirusTotalAnalysis $virusTotalAnalysis): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User               $user
     * @param \App\Models\VirusTotalAnalysis $virusTotalAnalysis
     *
     * @return bool
     */
    public function restore(User $user, VirusTotalAnalysis $virusTotalAnalysis): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User               $user
     * @param \App\Models\VirusTotalAnalysis $virusTotalAnalysis
     *
     * @return bool
     */
    public function forceDelete(User $user, VirusTotalAnalysis $virusTotalAnalysis): bool
    {
        return false;
    }
}
