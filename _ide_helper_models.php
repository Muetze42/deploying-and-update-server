<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Activity
 *
 * @property int $id
 * @property string|null $log_name
 * @property string $description
 * @property string|null $subject_type
 * @property int|null $subject_id
 * @property string|null $event
 * @property string|null $causer_type
 * @property int|null $causer_id
 * @property \Illuminate\Support\Collection|null $properties
 * @property string|null $batch_uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $causer
 * @property-read \Illuminate\Support\Collection $changes
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @method static \Illuminate\Database\Eloquent\Builder|Activity causedBy(\Illuminate\Database\Eloquent\Model $causer)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forBatch(string $batchUuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forEvent(string $event)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forSubject(\Illuminate\Database\Eloquent\Model $subject)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity hasBatch()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity inLog(...$logNames)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereBatchUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCauserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCauserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereLogName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSubjectType($value)
 */
	class Activity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\App
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $source
 * @property string|null $homepage
 * @property string|null $security
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Release> $releases
 * @property-read int|null $releases_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UpdateRequest> $updateRequests
 * @property-read int|null $update_requests_count
 * @method static \Illuminate\Database\Eloquent\Builder|App active()
 * @method static \Illuminate\Database\Eloquent\Builder|App newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|App newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|App onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|App query()
 * @method static \Illuminate\Database\Eloquent\Builder|App whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereSecurity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|App withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|App withoutTrashed()
 */
	class App extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PersonalAccessToken
 *
 * @property int $id
 * @property string $tokenable_type
 * @property int $tokenable_id
 * @property string $name
 * @property string $token
 * @property array|null $abilities
 * @property \Illuminate\Support\Carbon|null $last_used_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $tokenable
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereAbilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereTokenableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereTokenableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalAccessToken whereUpdatedAt($value)
 */
	class PersonalAccessToken extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Release
 *
 * @property int $id
 * @property int $app_id
 * @property string $version
 * @property string $platform
 * @property array|null $notes
 * @property array|null $hashes
 * @property string|null $virus_total_id
 * @property string|null $filename
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\App $app
 * @method static \Illuminate\Database\Eloquent\Builder|Release active()
 * @method static \Illuminate\Database\Eloquent\Builder|Release filterByChannel(?string $channel)
 * @method static \Illuminate\Database\Eloquent\Builder|Release newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Release newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Release onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Release query()
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereHashes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereLocales(string $column, array $locales)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release whereVirusTotalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Release withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Release withoutTrashed()
 */
	class Release extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UpdateRequest
 *
 * @property int $id
 * @property string $reachable_type
 * @property int $reachable_id
 * @property string|null $client
 * @property string|null $platform
 * @property string|null $version
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $apps
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest whereReachableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest whereReachableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UpdateRequest whereVersion($value)
 */
	class UpdateRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property bool $is_admin
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VirusTotalAnalysis
 *
 * @property string $id
 * @property string $status
 * @property array|null $results
 * @property array|null $stats
 * @property \Illuminate\Support\Carbon|null $vt_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis query()
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis whereResults($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis whereStats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VirusTotalAnalysis whereVtDate($value)
 */
	class VirusTotalAnalysis extends \Eloquent {}
}

