<?php
return [
    'name' => env('APP_NAME', 'Laravel PWA'),
    'short_name' => 'PWA',
    'theme_color' => '#0d6efd',
    'background_color' => '#ffffff',
    'display' => 'standalone',
    'start_url' => '/',
    'icons' => [
        [
            'src' => '/pwa/icons/icon-192x192.png',
            'sizes' => '192x192',
            'type' => 'image/png',
        ],
        [
            'src' => '/pwa/icons/icon-512x512.png',
            'sizes' => '512x512',
            'type' => 'image/png',
        ]
    ],
];