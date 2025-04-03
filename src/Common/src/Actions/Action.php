<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Actions;

/** @experimental */
abstract class Action
{
    public static function dispatch(mixed ...$params): mixed
    {
        $action = static::make(...$params);

        if ($action->authorize()) {
            return $action->handle();
        }

        return null;
    }

    public static function make(mixed ...$params): static
    {
        return new static(...$params);
    }

    abstract public function handle(): mixed;

    public function authorize(): bool
    {
        return true;
    }
}