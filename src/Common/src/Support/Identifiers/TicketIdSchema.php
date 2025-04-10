<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Support\Identifiers;

use Illuminate\Support\Carbon;

/** @experimental */
readonly class TicketIdSchema implements IdentifierSchema
{
    public function __construct(
        private string $prefix = "CS",
        private bool $useDate = true,
        private int $targetLength = 10,
        private int $maxPadding = 3,
        private string $paddingCharacter = "0",
        private string $cacheKey = "ticketIdSchema"
    ) {}

    public function generatePrefix(): string
    {
        if (!$this->useDate) {
            return $this->prefix;
        }

        $date = Carbon::now();

        return sprintf(
            "%s%s%s%s",
            $this->prefix,
            $date->format("y"),  // Last two digits of year
            $date->format("m"),  // Month
            $date->format("d")   // Day
        );
    }

    public function getTargetLength(): int
    {
        return $this->targetLength;
    }

    public function getMaxPadding(): int
    {
        return $this->maxPadding;
    }

    public function getCacheKey(): string
    {
        return $this->cacheKey;
    }

    public function getPaddingCharacter(): string
    {
        return $this->paddingCharacter;
    }
}