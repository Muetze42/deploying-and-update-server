<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Release;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Closure;

class ReleaseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\App          $app
     *
     * @return void
     * @throws \Exception
     */
    public function draftRelease(Request $request, App $app)
    {
        $request->validate([
            'version' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($app) {
                    if (
                        Release::where('app_id', $app->getKey())->where($attribute, $value)->exists()
                    ) {
                        $fail(
                            __('Version :version already exists for app :app.', [
                                'version' => $value,
                                'app' => $app->name
                            ])
                        );
                    }
                },
            ],
            'platform' => [
                'required',
                Rule::in(['aix', 'darwin', 'freebsd', 'linux', 'openbsd', 'sunos', 'win32'])
            ],
            'notes' => ['nullable', 'array'],
            'file' => [
                'required',
                File::types([
                    'application/octet-stream', // .dmg, .tar.gz
                    'application/vnd.debian.binary-package', // .deb (Ubuntu/Debian)
                    'application/x-bzip2', // .bz2
                    'application/x-dosexec', // .exe
                    'application/x-mach-binary', // macOS
                    'application/x-rpm', // Fedora/CentOS/SUSE
                    'application/x-tar', // FreeBSD
                    'application/zip', // .zip, .apk
                ])
            ]
        ]);

        $filename = Str::slug($app->name) . '-' . $request->input('version') . '-setup.' .
            $request->file('file')->getClientOriginalExtension();

        $request->file('file')->storeAs(
            $app->getKey(),
            $filename,
            'releases'
        );

        return $app->releases()->create(
            $request->only(['version', 'platform', 'notes']) + ['filename' => $filename]
        );
    }
}
