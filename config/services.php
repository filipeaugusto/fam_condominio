<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'inter' => [
        'base_url' => env('INTER_SANDBOX', true)
            ? 'https://cdpj-sandbox.partners.uatinter.co'
            : 'https://cdpj.partners.bancointer.com.br',

        'client_id' => env('INTER_CLIENT_ID', '328fa4b3-a282-4cfb-9b0b-04ab66ef4d19'),
        'client_secret' => env('INTER_CLIENT_SECRET', '6365d861-8e29-46fa-9980-cbe646028973'),
        'cert_password' => env('INTER_CERTIFICATE_PASSWORD', '1234567890'),
    ],

    // clientId: 2fae0155-99f3-4cc1-926e-45003e790e73
    // clientSecret: fadc00e7-aebc-48c5-97ed-b6b01f337b05
];
