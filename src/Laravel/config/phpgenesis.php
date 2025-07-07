<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

return [
    "amazonWebServices" => [
        "credentials" => [
            "key" => env("AWS_ACCESS_KEY_ID", ""),
            "secret" => env("AWS_SECRET_ACCESS_KEY", ""),
        ],
        "region" => env("AWS_DEFAULT_REGION", "us-east-1"),
        "version" => "2010-12-01",
    ],
    "cloudflare" => [
        "accountId" => env("PHPGENESIS_SERVICES_CLOUDFLARE_ACCOUNT_ID"),
        "email" => env("PHPGENESIS_SERVICES_CLOUDFLARE_EMAIL"),
        "apiKey" => env("PHPGENESIS_SERVICES_CLOUDFLARE_API_KEY"),
        "defaultContactProfile" => "default",
        "contactProfiles" => [
            "default" => [
                "firstName" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_FIRST_NAME"),
                "lastName" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_LAST_NAME"),
                "email" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_EMAIL"),
                "phone" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_PHONE"),
                "addressLine1" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_ADDRESS_LINE_1"),
                "addressLine2" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_ADDRESS_LINE_2"),
                "city" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_CITY"),
                "state" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_STATE"),
                "postalCode" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_POSTAL_CODE"),
                "country" => env("PHPGENESIS_SERVICES_CLOUDFLARE_DEFAULT_PROFILE_COUNTRY"),
            ],
        ],
    ],
    "logger" => [
        "exception" => [
            "includeStackTrace" => env("PHPGENESIS_LOGGER_EXCEPTION_INCLUDE_STACK_TRACE", true),
        ],
    ],
];
