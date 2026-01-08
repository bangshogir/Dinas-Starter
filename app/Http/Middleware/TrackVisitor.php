<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();

        // Check if visitor already exists today
        $visitor = \App\Models\Visitor::where('ip_address', $ipAddress)
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->first();

        if (!$visitor) {
            \App\Models\Visitor::create([
                'ip_address' => $ipAddress,
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
