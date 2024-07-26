<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

return [
    'amazonWebServices' => [
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID', ''),
            'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
        ],
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'version' => '2010-12-01',
    ],
    'logger' => [
        'exception' => [
            'includeStackTrace' => env('PHPGENESIS_LOGGER_EXCEPTION_INCLUDE_STACK_TRACE', true),
        ],
    ],
];
