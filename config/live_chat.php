<?php

return [
    'enabled' => (bool) env('LIVE_CHAT_ENABLED', false),
    'provider' => env('LIVE_CHAT_PROVIDER', 'tawk'),
    'embed' => env('LIVE_CHAT_EMBED', ''),
];
