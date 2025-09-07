<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Actions;

abstract class Action implements IAction
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

    /** @phpstan-ignore-next-line Allow undefined return type */
    abstract public function handle();

    public function authorize(): bool
    {
        return true;
    }
}