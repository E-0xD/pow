<?php

namespace App\Http\Controllers\Portfolio;

use App\Enums\PortfolioVisibility;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendPortfolioMessage;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($portfolio_slug)
    {

        $portfolio = Portfolio::where('slug', $portfolio_slug)->where('visibility', PortfolioVisibility::PUBLIC)->first();

        if (!$portfolio) {
            return redirect()->away(config('app.url') . route('guest.welcome', [], false))
                ->with([
                    'type' => 'info',
                    'message' => 'We could not find this portfolio.'
                ]);
        }

        $portfolio->load([
            'template',
            'about',
            'experiences',
            'educationRecords',
            'projects',
            'sectionOrders',
            'skills',
            'contactMethods'
        ]);


        // Get earliest & latest dates safely
        $earliest = $portfolio->experiences->min('start_date');
        $latest   = $portfolio->experiences->max('end_date');

        if ($earliest && $latest) {
            // Convert to Carbon
            $start = Carbon::parse($earliest);
            $end   = Carbon::parse($latest);

            // Calculate total days
            $days = $start->diffInDays($end);

            // Convert days → years (365) and round to nearest integer
            $years_of_experience = round($days / 365);

            // Enforce minimum of 1 year
            $years_of_experience = max(1, $years_of_experience);
        } else {
            $years_of_experience = 1; // fallback
        }

        return view($portfolio->template->file_path.'.index', compact('portfolio', 'years_of_experience'));
    }

    /**
     * Store a new message for the portfolio
     */
    public function storeMessage(SendPortfolioMessage $request, $portfolio_slug)
    {
        $portfolio = Portfolio::where('slug', $portfolio_slug)->firstOrFail();


        $portfolio->messages()->create($request->validated());

        return back()->with([
            'type' => 'success',
            'message' => 'Your message has been sent successfully!'
        ]);
    }
}
