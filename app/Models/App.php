<?php

namespace App\Models;

use App\Traits\Models\CanActiveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use NormanHuth\HelpersLaravel\Traits\Spatie\LogsActivityTrait;

class App extends Model
{
    use CanActiveTrait;
    use HasFactory;
    use LogsActivityTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'source',
        'homepage',
        'security'
    ];

    /**
     * Get the releases of the app.
     */
    public function releases(): HasMany
    {
        return $this->hasMany(Release::class);
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::creating(function (self $app) {
            $app->slug = Str::slug($app->name);
        });
    }

    /**
     * Get all of the update requests for the app.
     */
    public function updateRequests(): MorphMany
    {
        return $this->morphMany(UpdateRequest::class, 'reachable');
    }
}
