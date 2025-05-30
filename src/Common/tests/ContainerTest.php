<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

use Illuminate\Container\Container;
use PHPGenesis\Common\Container\PhpGenesisContainer;

it("Check if Laravel Exists", function (): void {
    $container = new PhpGenesisContainer;
    expect($container->isLaravel())->toBeTrue()
        ->and($container::getInstance())->toBeInstanceOf(Container::class);
});
