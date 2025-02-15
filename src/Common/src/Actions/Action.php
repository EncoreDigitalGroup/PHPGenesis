<?php

namespace PHPGenesis\Common\Actions;

/** @experimental */
abstract class Action
{
    public static function dispatch(mixed ...$params): static
    {
        return static::make(...$params)->handle();
    }

    public static function make(mixed ...$params): static
    {
        return new static(...$params);
    }

    abstract public function handle(): static;
}