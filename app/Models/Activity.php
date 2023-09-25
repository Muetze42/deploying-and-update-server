<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity as Model;
use Illuminate\Database\Eloquent\Builder;

class Activity extends Model
{
    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    public const UPDATED_AT = null;

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('withoutUsers', function (Builder $builder) {
            if (!Auth::check()) {
                /* @var self|Builder $builder */
                $builder->where('log_name', '!=', 'users');
            }
        });
    }
}
