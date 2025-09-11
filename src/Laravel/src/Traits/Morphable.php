<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Laravel\Traits;

use EncoreDigitalGroup\StdLib\Objects\Support\Types\Str;

/** @phpstan-ignore-next-line trait.unused */
trait Morphable
{
    public static function morphName(): string
    {
        return Str::snake(class_basename(static::class));
    }
}