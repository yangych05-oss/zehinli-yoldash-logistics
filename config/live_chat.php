<?php

return [
    'enabled' => (bool) env('LIVE_CHAT_ENABLED', false),
    'provider' => env('LIVE_CHAT_PROVIDER', 'tawk'),
    'src' => env('LIVE_CHAT_SRC', ''),
];
