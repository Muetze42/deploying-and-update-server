<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class UpdateRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client',
        'platform',
        'version',
    ];

    /**
     * Get all of the apps that are assigned this request.
     */
    public function apps(): MorphTo
    {
        return $this->morphTo(App::class, 'reachable');
    }
}
