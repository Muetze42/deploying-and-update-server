<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

trait CanActiveTrait
{
    /**
     * Scope a query to only include active model.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }

    /**
     * Initialize trait on the model.
     *
     * @return void
     */
    public function initializeCanActiveTrait(): void
    {
        $this->mergeCasts(['active' => 'bool']);
        $this->mergeFillable(['active']);
    }
}
