<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Right Reserved.
 */

declare(strict_types=1);

use PHPGenesis\DevUtilities\Rector\Rector;

return Rector::configure()
    ->withPaths([
        __DIR__ . "/src",
    ]);