<?php

return [
    'use_cdn' => env('USE_CDN', false),
    'cdn_url' => 'https://'.env('AWS_BUCKET').'.s3.'.env('AWS_DEFAULT_REGION').'.amazonaws.com',
    'filesystem' => [
        'disk' => 'public',
        'options' => [
            // File is available to the public, independent of the S3 Bucket policy
            'ACL' => 'public-read',
            // Sets HTTP Header 'cache-control'. The client should cache the file for max 1 year
            'CacheControl' => 'max-age=31536000, public',
        ],
    ],
    'files' => [
        'ignoreDotFiles' => true,
        'ignoreVCS' => true,
        'include' => [
            'paths' => [
                'css',
                'fonts',
                'images',
                'js',
                'packages',
            ],
            'files' => [],
            'extensions' => [],
            'patterns' => [],
        ],
        'exclude' => [
            'paths' => [
                'private',
            ],
            'files' => [],
            'extensions' => [],
            'patterns' => [],
        ],
    ],
];
