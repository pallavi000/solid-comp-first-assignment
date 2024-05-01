<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class RestrictionController extends Controller
{
    public function restricted(Request $request): Response
    {
        return Inertia::render('User/Restricted/Success', [
            'message' => "Congratulations! You are able to view this restricted page."
        ]);
    }

    /**
     * Add Ip to allowed ips
     */
    public function addAllowedIp(Request $request): RedirectResponse
    {
        $request->validate([
            'ip' => ['required', 'string'],
        ]);
        $user = $request->user();
        // Add the IP address to the allowed_ips array
        $allowedIps = json_decode($user->allowed_ip, true) ?? [];
        $allowedIps[] = $request->input('ip');
        // Update the user's allowed_ips column
        $user->update(['allowed_ip' => $allowedIps]);
        return Redirect::route('dashboard');
    }

    public function removeAllowedIp(Request $request): RedirectResponse
    {
        $request->validate([
            'ip' => ['required', 'string'],
        ]);
        $user = $request->user();
        // Remove the IP address from the allowed_ips array
        $ipToRemove = $request->input('ip');
        $allowedIps = json_decode($user->allowed_ip, true) ?? [];
        $allowedIps = array_diff($allowedIps, [$ipToRemove]);
        // Update the user's allowed_ips column
        $user->update(['allowed_ip' => $allowedIps]);
        return Redirect::route('dashboard');
    }
}
