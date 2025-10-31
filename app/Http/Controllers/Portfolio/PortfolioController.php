<?php

namespace App\Http\Controllers\Portfolio;

use App\Enums\PortfolioVisibility;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendPortfolioMessage;
use App\Models\Portfolio;
use Illuminate\Http\Request;

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


        return view($portfolio->template->file_path, compact('portfolio'));
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
