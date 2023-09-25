<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param string                   $slug
     * @param string                   $platform
     * @param string                   $version
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request, string $slug, string $platform, string $version)
    {
        $app = App::where('slug', $slug)->firstOrFail();
        $channel = $request->header('channel');

        $app->updateRequests()->create([
            'client' => $request->header('machineId'),
            'platform' => $platform,
            'version' => $version
        ]);

        /* @var \App\Models\Release $appReleases */
        $appReleases = $app->releases();
        $release = $appReleases->active()
            ->where('platform', $platform)
            ->where('version', $version)
            ->first();

        if (!$release) {
            /* @var \App\Models\Release $appReleases */
            $appReleases = $app->releases();
            $release = $appReleases->active()->filterByChannel($channel)
                ->where('platform', $platform)
                ->orderByDesc('created_at')
                ->first();
        }

        if (!$release) {
            abort(404);
        }

        $defaultLocale = config('app.locale');
        $locale = Str::lower($request->header('locale', $defaultLocale));
        if ($locale != $defaultLocale) {
            \Illuminate\Support\Facades\App::setLocale($locale);
        }

        /* @var \App\Models\Release $appReleases */
        $appReleases = $app->releases();
        $releases = $appReleases->active()->filterByChannel($channel)
            ->where('created_at', '>', $release->created_at)
            ->orderByDesc('created_at')
            ->get();

        if (!$releases->count()) {
            return jsonResponse(200, [], [
                'available' => false
            ]);
        }

        $notes = [];

        /* @var array<\App\Models\Release> $releases */
        foreach ($releases as $release) {
            if ($release->notes) {
                $note = '# ' . $release->version . "\n\n" . $release->notes;
                $notes[] = $note;
            }
        }

        $release = $releases->first();

        $notes = !empty($notes) ? implode("\n\n---\n\n", $notes) : null;

        return jsonResponse(200, [], [
            'available' => true,
            'version' => $release->version,
            'notes' => $notes,
            'notes_html' => $notes ? Str::markdown($notes) : null,
            'file' => [
                'name' => $release->filename,
                'hashes' => $release->hashes
            ],
            'created_at' => $release->created_at,
            'updated_at' => $release->updated_at,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param string                   $slug
     * @param string                   $platform
     *
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(Request $request, string $slug, string $platform)
    {
        $app = App::where('slug', $slug)->firstOrFail();

        $channel = $request->header('channel');

        /* @var \App\Models\Release $appReleases */
        $appReleases = $app->releases();
        $release = $appReleases->active()->filterByChannel($channel)
            ->active()->filterByChannel($channel)
            ->where('platform', $platform)
            ->orderByDesc('created_at')
            ->firstOrFail();

        return Storage::disk('releases')->download($app->getKey() . '/' . $release->filename);
    }
}
