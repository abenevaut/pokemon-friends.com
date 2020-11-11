<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'amazon' => [
        'keywords' => [
            'Nintendo Pokemon',
            'Nintendo Pokemon Go Plus',
            'Controller Gear Officially Licensed Nintendo Switch Skin & Screen Protector Set - Pokemon',
            'Pokemon T-Shirts',
            'Pokemon Mug',
            'Pokemon Hat',
            'Pokemon Bags',
            'Pokemon Cards',
        ],
    ],

    'youtube' => [
        'backgrounds' => [
            'https://www.youtube.com/watch?v=X2KHZtmcrVA',
            'https://www.youtube.com/watch?v=3HU10cLg5xk',
            'https://www.youtube.com/watch?v=EmhyG_d1QKU',
            'https://www.youtube.com/watch?v=C461fBV-J7c',
            'https://www.youtube.com/watch?v=MynNG2IRZDI',
        ],
    ],

    'github' => [
        'url' => 'https://github.com/pokemon-friends-com/www',
        'nextgen' => 'https://github.com/pokemon-friends-com/www/milestones',
        'changelog' => 'https://github.com/pokemon-friends-com/www/milestones?state=closed',
        'issues' => 'https://github.com/pokemon-friends-com/www/issues',
    ],

    pkmnfriends\Infrastructure\Interfaces\Domain\Users\ProvidersTokens\ProvidersInterface::GOOGLE => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI', '/login/google/callback'),
        'api_key' => env('GOOGLE_APIKEY'),
    ],

    'google_tag_manager' => [
        'id' => env('GOOGLE_TM_ID', ''),
        'auth' => env('GOOGLE_TM_AUTH', ''),
        'env' => env('GOOGLE_TM_ENV', ''),
    ],

    pkmnfriends\Infrastructure\Interfaces\Domain\Users\ProvidersTokens\ProvidersInterface::TWITTER => [
        'consumer_key' => env('TWITTER_CONSUMER_KEY'),
        'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
        'access_token' => env('TWITTER_ACCESS_TOKEN'),
        'access_secret' => env('TWITTER_ACCESS_SECRET'),
        'client_id' => env('TWITTER_CONSUMER_KEY'),
        'client_secret' => env('TWITTER_CONSUMER_SECRET'),
        'redirect' => env('TWITTER_REDIRECT_URI', '/login/twitter/callback'),
        'username' => '@pkmn_friends',
        'url' => 'https://twitter.com/pkmn_friends',
        /*
        |--------------------------------------------------------------------------
        | Site Card
        |--------------------------------------------------------------------------
        |
        | Twitter : twitter:card = summary, summary_large_image, app, player
        |
        */
        'card' => 'summary_large_image',
        'image' => '/images/og-image.jpg',
    ],

    'facebook' => [
        /*
        |--------------------------------------------------------------------------
        | Site type
        |--------------------------------------------------------------------------
        |
        | Facebook : og:type = https://developers.facebook.com/docs/reference/opengraph
        |
        */
        'og:type' => 'website',
        'og:image' => '/images/og-image.jpg',
    ],

];
