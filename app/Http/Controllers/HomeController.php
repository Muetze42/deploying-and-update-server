<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Routing\Route;
use NormanHuth\Helpers\Arr;

class HomeController extends Controller
{
    /**
     * The Authorization notice.
     *
     * @var string
     */
    protected string $authNotice = '<Authorization required>';

    /**
     * The Response data.
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Packages with version from composer.lock file.
     *
     * @var array
     */
    protected array $packages;

    /**
     * Verify API accessibility and give out some information about the app.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $contents = json_decode(file_get_contents(
            base_path('composer.json')
        ), true);
        $lockContents = json_decode(file_get_contents(
            base_path('composer.lock')
        ), true);
        $this->packages = collect(data_get($lockContents, 'packages'))
            ->pluck('version', 'name')->toArray();

        $this->fillData($contents);
        $this->setRoutes();
//        $this->setRequireVersions();
        //$this->setPackages();

        return jsonResponse(
            200,
            null,
            array_filter($this->data, fn($value) => $value != null)
        );
    }

    /**
     * @return void
     */
    protected function setRoutes(): void
    {
        $routes = app('router')->getRoutes()->getRoutesByName();
        ksort($routes);
        $routes = Arr::where($routes, function (Route $route) {
            return in_array('api', $route->middleware());
        });
        $routes = Arr::mapWithKeys($routes, function (Route $route, string $key) {
            $value = '/' . ltrim($route->uri(), '/') . ' [' . implode('|', $route->methods()) . ']';

            $middleware = array_diff($route->middleware(), $route->excludedMiddleware());

            if (count(array_intersect(['auth:sanctum', 'auth:basic'], $middleware))) {
                $value .= ' ' . $this->authNotice;
            }

            return [$key => $value];
        });

        if (!Auth::check()) {
            $routes = array_filter($routes, fn($value) => !str_contains($value, $this->authNotice));
        }

        $routes = Arr::undot($routes);

        $this->data = Arr::keyValueInsertToPosition($this->data, 'routes', $routes, 3);
    }

    protected function fillData(array $contents): void
    {
        $keys = ['authors', 'license', 'description', 'support', 'keywords', 'require'];
        foreach ($keys as $key) {
            $this->data[$key] = data_get($contents, $key);
        }
    }

    /**
     * @return void
     */
    protected function setRequireVersions(): void
    {
        foreach ($this->data['require'] as $package => $version) {
            $version = data_get($this->packages, $package);
            if (!$version) {
                continue;
            }

            if (str_contains($version, '.')) {
                $version = '^' . $version;
            }

            data_set($this->data, 'require.' . $package, $version);
        }
    }

    /**
     * @return void
     */
    protected function setPackages(): void
    {
        $phpV = explode('.', phpversion());
        $phpV = $phpV[0] . $phpV[1];

        $this->data['packages'] = Arr::where($this->packages, function (string|int $value, string $key) use ($phpV) {
            if (!str_starts_with($key, 'symfony/polyfill-php')) {
                return true;
            }

            return (int) preg_replace('~\D~', '', $key) > $phpV;
        });
    }
}
