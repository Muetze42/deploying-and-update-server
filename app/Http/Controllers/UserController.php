<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use NormanHuth\LaravelApiController\Controller;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Validate the given data against the provided rules.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function validateRulesOnStore(Request $request): array
    {
        return [
            'name' => ['required', Rule::unique('users')],
            'email' => ['required', Rule::unique('users')],
            'password' => ['required', Password::defaults()],
        ];
    }

    /**
     * Validate the given data against the provided rules on "update".
     *
     * @param \Illuminate\Http\Request            $request
     * @param \Illuminate\Database\Eloquent\Model $object
     *
     * @return array
     */
    protected function validateRulesOnUpdate(Request $request, Model $object): array
    {
        return [
            'name' => ['nullable', Rule::unique('users')->ignore($object)],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($object)],
            'password' => ['nullable', Password::defaults()],
        ];
    }
}
