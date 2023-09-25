<?php

namespace App\Models;

use App\Traits\Models\CanActiveTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use NormanHuth\HelpersLaravel\Traits\Spatie\LogsActivityTrait;
use Spatie\Translatable\HasTranslations;

class Release extends Model
{
    use CanActiveTrait;
    use HasFactory;
    use LogsActivityTrait;
    use SoftDeletes;
    use HasTranslations;

    public array $translatable = ['notes'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'version',
        'platform',
        'notes',
        'filename',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'hashes' => 'array'
    ];

    /**
     * Get the app that owns the release.
     */
    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    public static function booted(): void
    {
        static::saving(function (self $release) {
            if (!$release->active && $release->filename) {
                $file = Storage::drive('releases')->path($release->app->getKey() . '/' . $release->filename);
                $release->hashes = [
                    'md5' => md5_file($file),
                    'sha1' => sha1_file($file)
                ];
                $release->active = true; // Queue: Activate after VirusTotal scan
            }
        });
    }

    /**
     * Scope a query to only include wanted release channel.
     */
    public function scopeFilterByChannel(Builder $query, ?string $channel): void
    {
        /* @var self|Builder $query */
        switch ($channel) {
            case 'alpha':
                break;
            case 'beta':
                $query->where('version', 'not like', '%alpha%');
                break;
            case 'rc':
            case 'release-candidate':
                $query->where('version', 'not like', '%alpha%')
                    ->where('version', 'not like', '%beta%');
                break;
            default:
                $query->where('version', 'not like', '%alpha%')
                    ->where('version', 'not like', '%beta%')
                    ->where('version', 'not like', '%rc%');
        }
    }
}
