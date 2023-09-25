<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NormanHuth\HelpersLaravel\Traits\Spatie\LogsActivityTrait;

class VirusTotalAnalysis extends Model
{
    use HasFactory;
    use LogsActivityTrait;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'status',
        'results',
        'stats',
        'vt_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'results' => 'array',
        'stats' => 'array',
        'vt_date' => 'datetime',
    ];
}
