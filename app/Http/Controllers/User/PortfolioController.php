<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\Template;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $portfolios = Auth::user()->portfolios()->latest()->paginate(10);
        return view('user.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
       
        $templates = Template::where('status', 'published')->get();
        
        return view('user.portfolio.create', compact('templates'));
    }

    public function store(PortfolioRequest $request)
    {
        $data = $request->validated();
        
        $portfolio = Auth::user()->portfolios()->create($data);

        return redirect()->route('user.portfolio.customize', $portfolio)
            ->with([
                    'type' => 'error',
                    'message' => 'Portfolio created successfully'
                ]);
    }

    public function show(Portfolio $portfolio)
    {
        // dd($portfolio);
        $this->authorize('view', $portfolio);
        return view('user.portfolio.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        return view('user.portfolio.edit', compact('portfolio'));
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        
        $data = $request->validated();

        if ($request->hasFile('favicon')) {
            if ($portfolio->favicon) {
                Storage::disk('public')->delete($portfolio->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
        }

        $portfolio->update($data);

        return redirect()->route('user.portfolio.index')
            ->with('success', 'Portfolio updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorize('delete', $portfolio);

        if ($portfolio->favicon) {
            Storage::disk('public')->delete($portfolio->favicon);
        }
        
        $portfolio->delete();

        return redirect()->route('user.portfolio.index')
            ->with('success', 'Portfolio deleted successfully.');
    }

    public function customize(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        return view('user.portfolio.customize', compact('portfolio'));
    }
}
