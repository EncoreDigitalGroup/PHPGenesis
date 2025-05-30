<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

declare(strict_types=1);

use PHPGenesis\DevUtilities\Rector\Rector;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . "/src",
    ])
    ->withRules(Rector::rules());
