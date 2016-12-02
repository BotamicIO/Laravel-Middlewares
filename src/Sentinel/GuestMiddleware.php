<?php

/*
 * This file is part of Laravel Middlewares.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Middlewares\Sentinel;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GuestMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::check()) {
            throw new AccessDeniedHttpException(trans('auth.errors.invalid_permission'));
        }

        return $next($request);
    }
}