<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('app:about', function () {
    $this->comment('ZNY LOGISTICS platform is ready.');
});
