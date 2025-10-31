<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;


require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/portfolio.php';

Route::view('/', 'guest.welcome')->name('guest.welcome');

Route::view('features', 'guest.features')->name('guest.features');

Route::view('pricing', 'guest.pricing')->name('guest.pricing');

Route::view('about', 'guest.about')->name('guest.about');

Route::view('templates', 'guest.templates')->name('guest.templates');

Route::view('contact', 'guest.contact')->name('guest.contact');



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
