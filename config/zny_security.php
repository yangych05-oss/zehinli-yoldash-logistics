<?php

return [
    // Do not preload or apply HSTS to subdomains until every host is tested.
    'hsts_enabled' => (bool) env('ZNY_HSTS_ENABLED', false),
];
