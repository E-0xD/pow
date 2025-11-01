<?php

return [
    'url' => env('APP_ENV') == 'local'
        ? 'https://sandbox-api.polar.sh/v1'
        : 'https://api.polar.sh/v1',
        
    'access_token' => env('POLAR_ACCESS_TOKEN'),
];
