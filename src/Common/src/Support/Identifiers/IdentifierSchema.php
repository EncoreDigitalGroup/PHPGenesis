<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Support\Identifiers;

/** @experimental */
interface IdentifierSchema
{
    public function generatePrefix(): string;

    public function getTargetLength(): int;

    public function getMaxPadding(): int;

    public function getPaddingCharacter(): string;

    public function getCacheKey(): string;
}