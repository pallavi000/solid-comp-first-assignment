<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function dashboard(Request $request): Response
    {
        $totalUsers = User::count();
        return Inertia::render('Admin/AdminDashboard', [
            'totalUsers' => $totalUsers,
        ]);
    }
}
