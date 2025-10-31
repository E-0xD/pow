<?php

use App\Http\Controllers\Admin\TemplateController;
use Illuminate\Support\Facades\Route;

Route::domain('admin.' . parse_url(config('app.url'), PHP_URL_HOST))->name('admin.')->group(function () {
    Route::resource('template', TemplateController::class);
});