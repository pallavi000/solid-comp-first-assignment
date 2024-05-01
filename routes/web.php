<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestrictionController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


// dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


// auth protected routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post("/restricted/ip/add", [RestrictionController::class, 'addAllowedIp'])->name('restricted.ip.add');
    Route::post("/restricted/ip/remove", [RestrictionController::class, 'removeAllowedIp'])->name('restricted.ip.remove');
});

// ip restricted routes
Route::middleware(['auth', 'ipRestriction'])->group(function () {
    Route::get("/restricted", [RestrictionController::class, 'restricted'])->name('restricted.home');
});


// admin routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get("/admin", [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

require __DIR__ . '/auth.php';
