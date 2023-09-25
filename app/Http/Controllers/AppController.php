<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use NormanHuth\LaravelApiController\Controller;
use Illuminate\Database\Eloquent\Model;

class AppController extends Controller
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
            'name' => ['required', Rule::unique('apps')],
            'active' => ['nullable', 'bool']
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
            'active' => ['nullable', 'bool']
        ];
    }
}
