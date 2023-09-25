<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    /**
     * Determine if the token has a given ability.
     *
     * @param  string  $ability
     * @return bool
     */
    public function can($ability): bool
    {
        $parts = explode(':', $ability);

        if (array_key_exists($parts[0] . ':*', array_flip($this->abilities))) {
            return true;
        }

        return in_array('*', $this->abilities) ||
            array_key_exists($ability, array_flip($this->abilities));
    }
}
