<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Traits;

use ReflectionClass;

trait HasMake
{
    public static function make(...$params): static
    {
        $reflection = new ReflectionClass(static::class);

        if ($reflection->hasMethod("__construct")) {
            return new static(...$params);
        }

        $instance = new static;
        foreach ($params as $key => $value) {
            if (property_exists($instance, $key)) {
                $instance->{$key} = $value;
            }
        }

        return $instance;
    }
}