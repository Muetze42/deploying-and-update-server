<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use NormanHuth\Helpers\Str;
use NormanHuth\HelpersLaravel\Services\AbilityFinder;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new personal access token for the user.
     *
     * @throws \ReflectionException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'token_name' => 'string|nullable',
            'abilities' => 'array|nullable',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'credentials' => [__('auth.failed')],
            ]);
        }

        $abilities = $request->input('abilities', ['*']);
        $availableAbilities = AbilityFinder::findAbilities(null, null, ':*');
        $availableAbilities[] = '*';

        $notExistingAbilities = array_diff($abilities, $availableAbilities);

        if (count($notExistingAbilities)) {
            $notExistingAbilities = array_map(fn($ability) => '`' . $ability . '`', $notExistingAbilities);
            $message = __('The Abilities :abilities not exists.', [
                'abilities' => Str::lastAnd($notExistingAbilities)
            ]);

            throw ValidationException::withMessages([
                'abilities' => [$message],
            ]);
        }

        if (in_array('*', $abilities)) {
            $abilities = ['*'];
        }

        sort($abilities);

        if (count($abilities) > 1) {
            foreach ($abilities as $ability) {
                if (str_ends_with($ability, ':*')) {
                    $abilities = array_filter($abilities, function ($value) use ($ability) {
                        $main = explode(':', $ability)[0];
                        return $value == $ability || !str_starts_with($value, $main . ':');
                    });
                }
            }
        }

        $name = $request->input('token_name', __('Token from :now', ['now' => now()->toDateTimeString()]));

        $token = $user->createToken($name, $abilities);

        /* @var \App\Models\PersonalAccessToken $accessToken */
        $accessToken = $token->accessToken;

        return jsonResponse(
            SymfonyResponse::HTTP_CREATED,
            null,
            [
                'token' => $token->plainTextToken,
                'accessToken' => [
                    'name' => $accessToken->name,
                    'expires_in' => $accessToken->expires_at,
                    'abilities' => $accessToken->abilities,
                ]
            ]
        );
    }

    /**
     * Revoke the token that was used to authenticate the current request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return jsonResponse(
            SymfonyResponse::HTTP_OK,
            __('Revoked the token that was used to authenticate the current request.')
        );
    }
}
