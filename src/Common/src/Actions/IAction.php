<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Actions;

interface IAction
{
    public static function dispatch(mixed ...$params): mixed;

    public static function make(mixed ...$params): static;

    public function authorize(): bool;

    /** @phpstan-ignore-next-line Allow undefined return type. */
    public function handle();
}
