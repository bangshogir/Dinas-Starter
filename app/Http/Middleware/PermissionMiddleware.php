<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permission): mixed
    {
        if (!$request->user() || !$request->user()->hasPermissionTo($permission)) {
            throw UnauthorizedException::forPermissions([$permission]);
        }
        return $next($request);
    }
}