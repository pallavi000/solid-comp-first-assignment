<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class IpRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $this->isIpAllowed($request->ip(), $user->allowed_ips)) {
            return $next($request);
        }

        abort(403, 'IP address not authorized');
    }

    private function isIpAllowed($ip, $allowedIps)
    {
        if ($allowedIps === null) {
            return false;
        }

        return in_array($ip, $allowedIps);
    }
}
