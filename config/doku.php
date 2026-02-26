<?php

return [
    /*
    |--------------------------------------------------------------------------
    | DOKU Payment Gateway Configuration
    |--------------------------------------------------------------------------
    */

    'client_id'   => env('DOKU_CLIENT_ID', ''),
    'secret_key'  => env('DOKU_SECRET_KEY', ''),
    'is_sandbox'  => env('DOKU_IS_SANDBOX', true),

    'base_url' => env('DOKU_IS_SANDBOX', true)
        ? 'https://api-sandbox.doku.com'
        : 'https://api.doku.com',

    'notify_url'  => env('DOKU_NOTIFY_URL', ''),
    'success_url' => env('DOKU_SUCCESS_URL', ''),
    'failed_url'  => env('DOKU_FAILED_URL', ''),

    'payment_due_minutes' => 60, // Batas waktu bayar (menit)
];
