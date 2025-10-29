<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\throwException;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.form');
    }

    public function store(PortfolioRequest $request)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('thumbnail')) {
                $data['thumbnail_path'] = $request->file('thumbnail')->store('portfolios', 'public');
            }

            Portfolio::create($data);

            return redirect()->route('admin.portfolio.index')
                ->with([
                    'type' => 'success',
                    'message' => 'Portfolio created successfully!'
                ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('admin.portfolio.index')
                ->with([
                    'type' => 'error',
                    'message' => 'An error occurred while creating portfolio'
                ]);
        }
    }

    public function show(Portfolio $portfolio)
    {
        return view('admin.portfolio.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.form', compact('portfolio'));
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('thumbnail')) {
                if ($portfolio->thumbnail_path) {
                    Storage::disk('public')->delete($portfolio->thumbnail_path);
                }
                $data['thumbnail_path'] = $request->file('thumbnail')->store('portfolios', 'public');
            }

            $portfolio->update($data);

            return redirect()->route('admin.portfolio.index')->with([
                'type' => 'success',
                'message' => 'Portfolio updated successfully!'
            ]);

        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('admin.portfolio.index')
                ->with([
                    'type' => 'error',
                    'message' => 'An error occurred while updating portfolio'
                ]);
        }
    }

    public function destroy(Portfolio $portfolio)
    {
        try {
            if ($portfolio->thumbnail_path) {
                Storage::disk('public')->delete($portfolio->thumbnail_path);
            }

            $portfolio->delete();

            return redirect()->route('admin.portfolio.index')
                ->with([
                    'type' => 'success',
                    'message' => 'Portfolio Deleted successfully!'
                ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('admin.portfolio.index')
                ->with([
                    'type' => 'error',
                    'message' => 'An error occurred while deleting portfolio'
                ]);
        }
    }
}
