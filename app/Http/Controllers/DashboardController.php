<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function dashboard(Request $request): Response
    {
        $user = Auth::user();
        return Inertia::render('User/Dashboard/Dashboard', [
            'ip' => $request->ip(),
            'isIpAllowed' => $this->isIpAllowed($request->ip(), $user->allowed_ip)
        ]);
    }

    private function isIpAllowed($ip, $allowedIps)
    {
        if ($allowedIps === null) {
            return false;
        }

        $allowedIpsArray = json_decode($allowedIps, true);

        return in_array($ip, $allowedIpsArray);
    }
}
