<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
       $totalPortfolio =  Auth::user()->portfolios()->count();
        return view('user.dashboard.index', compact('totalPortfolio'));
    }
}
