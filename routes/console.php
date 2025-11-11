<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::exec(base_path('queue-monitor.sh'))->everyMinute();
Schedule::command('portfolio:delete-pending')->dailyAt('02:00');
Schedule::command('portfolio:expire-subscriptions')->everySixHours();