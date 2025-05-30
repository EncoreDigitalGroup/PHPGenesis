<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Support\Identifiers;

use EncoreDigitalGroup\StdLib\Objects\Support\Types\Str;
use Illuminate\Support\Facades\Cache;

/** @experimental */
class UniqueIdGenerator extends AbstractIdGenerator
{
    private int $lastNumber = 0;

    public function __construct(private readonly IdentifierSchema $schema)
    {
        $this->loadLastNumber();

    }

    protected function generate(): string
    {
        $prefix = $this->schema->generatePrefix();
        $prefixLength = strlen($prefix);
        $targetLength = $this->schema->getTargetLength();
        $paddingCharacter = $this->schema->getPaddingCharacter();
        $maxPadding = $this->schema->getMaxPadding();

        // Ensure target length is at least prefix length + 1
        $effectiveTargetLength = max($targetLength, $prefixLength + 1);

        // Check if we need to reset (new day or no previous number)
        $currentPrefix = $this->schema->generatePrefix();
        $nextNumber = $this->lastNumber + 1;

        if ($this->lastNumber === 0 || $this->getLastIdPrefix() !== $currentPrefix) {
            $nextNumber = 1;
        }

        $idString = $prefix . $nextNumber;
        $currentLength = Str::length($idString);

        if ($currentLength < $effectiveTargetLength) {
            $paddingNeeded = $effectiveTargetLength - $currentLength;
            $numberOfPaddingCharactersToUse = min($paddingNeeded, $maxPadding);
            $paddingLength = $numberOfPaddingCharactersToUse + strlen((string) $nextNumber);
            $idString = $prefix . str_pad((string) $nextNumber, $paddingLength, $paddingCharacter, STR_PAD_LEFT);
        }

        $this->saveLastNumber($nextNumber);

        return $idString;
    }

    private function loadLastNumber(): void
    {
        $cachedValue = Cache::get($this->schema->getCacheKey(), "0");
        $this->lastNumber = (int) $cachedValue;
    }

    private function saveLastNumber(int $number): void
    {
        Cache::forever($this->schema->getCacheKey(), (string) $number);
        $this->lastNumber = $number;
    }

    private function getLastIdPrefix(): string
    {
        return Str::empty();
    }
}