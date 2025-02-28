<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Traits;

trait HasMake
{
    public static function make(mixed ...$params): static
    {
        return new static(...$params);
    }
}