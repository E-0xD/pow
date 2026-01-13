<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::exec(base_path('queue-monitor.sh'))->everyMinute();
Schedule::command('portfolio:delete-pending')->dailyAt('02:00');
Schedule::command('subscriptions:process-expired')->everySixHours();
Schedule::command('auth:clear-resets')->everyFifteenMinutes();