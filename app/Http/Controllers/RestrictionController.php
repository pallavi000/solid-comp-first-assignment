<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RestrictionController extends Controller
{
    public function restricted(Request $request): Response
    {
        return Inertia::render('Restricted/Success', [
            'message' => "Congratulations! You are able to view this page.",
        ]);
    }
}
