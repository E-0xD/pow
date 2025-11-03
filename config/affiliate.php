<?php

return [
    // Number of days between automatic payout runs (default monthly ~30 days)
    'payout_interval_days' => env('AFFILIATE_PAYOUT_INTERVAL_DAYS', 30),

    // Minimum balance required to generate a payout (0 = any positive balance)
    'payout_minimum' => env('AFFILIATE_PAYOUT_MINIMUM', 0),
];
