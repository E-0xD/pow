<?php

use App\Http\Controllers\User\AffiliateController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PortfolioController;
use App\Livewire\Portfolio\Builder\PortfolioBuilder;
use App\Livewire\Message\Messages;
use App\Livewire\Message\View;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('portfolio', PortfolioController::class);
    Route::get('portfolio/{portfolio}/customize', PortfolioBuilder::class)->name('portfolio.customize');
    Route::get('portfolio/{portfolio}/analytics', [PortfolioController::class, 'analytics'])->name('portfolio.analytics');
    Route::get('messages', Messages::class)->name('messages.index');
    Route::get('messages/{message}', View::class)->name('messages.show');
    Route::resource('affiliate', AffiliateController::class)->middleware('ensure.affiliate');

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

        
});
