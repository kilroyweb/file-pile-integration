<?php

return [
    'enableInProduction' => env('FILEPILE_ENABLE_PRODUCTION', false),
    'baseURI' => env('FILEPILE_BASE_URI', 'https://filepile.io'),
    'apiKey' => env('FILEPILE_KEY', null),
];
