<?php

use App\Http\Controllers\Admin\TemplateController;
use Illuminate\Support\Facades\Route;
// 
Route::domain('admin.localhost')->name('admin.')->group(function () {
    Route::resource('template', TemplateController::class);
});
