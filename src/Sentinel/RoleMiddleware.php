<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Middlewares.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Middlewares\Sentinel;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class RoleMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $role = Sentinel::findRoleBySlug($role);

        if (! $request->user()->inRole($role)) {
            throw new AccessDeniedHttpException(trans('auth.errors.invalid_permission'));
        }

        return $next($request);
    }
}
