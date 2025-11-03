<?php

use Illuminate\Support\Facades\Route;


require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/portfolio.php';
require __DIR__ . '/payment.php';
require __DIR__ . '/api.php';


Route::middleware(['capture.affiliate'])->group(function () {
    Route::view('/', 'guest.welcome')->name('guest.welcome');

    Route::view('features', 'guest.features')->name('guest.features');

    Route::view('pricing', 'guest.pricing')->name('guest.pricing');

    Route::view('about', 'guest.about')->name('guest.about');

    Route::view('templates', 'guest.templates')->name('guest.templates');

    Route::view('contact', 'guest.contact')->name('guest.contact');
});
