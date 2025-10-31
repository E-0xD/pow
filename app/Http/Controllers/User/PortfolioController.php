<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioCreateRequest;
use App\Http\Requests\PortfolioUpdateRequest;
use App\Models\Portfolio;
use App\Models\Template;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $portfolios = Auth::user()
            ->portfolios()
            ->with('about')
            ->latest()
            ->paginate(10);

        return view('user.portfolio.index', compact('portfolios'));
    }

    public function create()
    {

        $templates = Template::where('status', 'published')->get();

        return view('user.portfolio.create', compact('templates'));
    }

    public function store(PortfolioCreateRequest $request)
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

    public function update(PortfolioUpdateRequest $request, Portfolio $portfolio)
    {
        try {
            $this->authorize('update', $portfolio);

            $data = $request->validated();

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                try {
                    if ($portfolio->favicon) {
                        Storage::disk('public')->delete($portfolio->favicon);
                    }
                    $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
                } catch (\Exception $e) {
                    dd('here');
                    return back()->with('error', 'Failed to upload favicon. Please try again.');
                }
            }
            $portfolio->update($data);

            return redirect()->route('user.portfolio.edit', $portfolio)
                ->with(
                    [
                        'type' => 'success',
                        'message' => 'Portfolio updated successfully!'
                    ]
                );
        } catch (\Exception $e) {
            Log::error($e);
            return back()
                ->withInput()
                ->with([
                    'type' => 'error',
                    'message' => 'Could not update portfolio, try again later!'
                ]);
        }
    }

    public function destroy(Portfolio $portfolio)
    {
        try {

            $this->authorize('delete', $portfolio);

            if ($portfolio->favicon) {
                Storage::disk('public')->delete($portfolio->favicon);
            }

            $portfolio->delete();

            return redirect()->route('user.portfolio.index')
                ->with(
                    [
                        'type' => 'success',
                        'message' => 'Portfolio deleted successfully.'
                    ]
                );
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with([
                'type' => 'error',
                'message' => 'Could not delete portfolio, try again later!'
            ]);
        }
    }

    public function customize(Portfolio $portfolio)
    {
        $this->authorize('update', $portfolio);
        return view('user.portfolio.customize', compact('portfolio'));
    }
}
