<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

use Illuminate\Container\Container;
use PHPGenesis\Common\Container\PhpGenesisContainer;

it('Check if Laravel Exists', function (): void {
    $container = new PhpGenesisContainer();
    expect($container->isLaravel())->toBeTrue()
        ->and($container::getInstance())->toBeInstanceOf(Container::class);
});
