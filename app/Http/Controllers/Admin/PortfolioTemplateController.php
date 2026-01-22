<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateUserPortfolio;
use App\Models\Portfolio;
use App\Models\Template;
use Illuminate\Support\Facades\Log;


class PortfolioTemplateController extends Controller
{
    public function edit(Portfolio $portfolio)
    {

        $templates = Template::all();
        return view('admin.user.portfolio-edit', compact('portfolio', 'templates'));
    }

    public function update(AdminUpdateUserPortfolio $request, Portfolio $portfolio)
    {

        try {
            $portfolio->update([
                'template_id' => $request->template_id
            ]);

            alert(type: 'success', message: 'Template updated successfully.');
            return redirect()->route('admin.user.show', $portfolio->user);
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to update template.');
            return back()->withInput();
        }
    }

    public function destroy(Portfolio $portfolio)
    {
        try {
            $user = $portfolio->user;
            $portfolio->delete();
            alert(type: 'success', message: 'User deleted.');
            return redirect()->route('admin.user.show', $user);
        } catch (\Throwable $th) {
            Log::error($th);
            alert(type: 'error', message: 'Failed to delete user.');
            return back();
        }
    }
}
