<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $latestResult = $user->results()->latest()->first();

        $totalTrackLevels = max(20, (int) $user->level + 5);
        $trackLevels = range(1, $totalTrackLevels);

        return view('dashboard.index', [
            'user' => $user,
            'latestResult' => $latestResult,
            'trackLevels' => $trackLevels,
        ]);
    }
}
