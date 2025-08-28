<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\OpenFeature;

use BackedEnum;
use EncoreDigitalGroup\StdLib\Objects\Enum;
use OpenFeature\interfaces\flags\EvaluationContext;
use OpenFeature\OpenFeatureAPI;

class OpenFeature
{
    public static function bool(BackedEnum|string $flagKey, bool $defaultValue = false, ?EvaluationContext $context = null): bool
    {
        $flagKey = self::enum($flagKey);
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveBooleanValue($flagKey, $defaultValue, $context)->getValue();

        if (is_bool($value)) {
            return $value;
        }

        return $defaultValue;
    }

    public static function string(string $flagKey, string $defaultValue = "", ?EvaluationContext $context = null): string
    {
        $flagKey = self::enum($flagKey);
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveStringValue($flagKey, $defaultValue, $context)->getValue();

        if (is_string($value)) {
            return $value;
        }

        return $defaultValue;
    }

    public static function int(string $flagKey, int $defaultValue = 0, ?EvaluationContext $context = null): int
    {
        $flagKey = self::enum($flagKey);
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveIntegerValue($flagKey, $defaultValue, $context)->getValue();

        if (is_int($value)) {
            return $value;
        }

        return $defaultValue;
    }

    public static function float(string $flagKey, float $defaultValue = 0.00, ?EvaluationContext $context = null): float
    {
        $flagKey = self::enum($flagKey);
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveFloatValue($flagKey, $defaultValue, $context)->getValue();

        if (is_float($value)) {
            return $value;
        }

        return $defaultValue;
    }

    public static function object(string $flagKey, array $defaultValue = [], ?EvaluationContext $context = null): object|array
    {
        $flagKey = self::enum($flagKey);
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveObjectValue($flagKey, $defaultValue, $context)->getValue();

        if (is_object($value)) {
            return $value;
        }

        return $defaultValue;
    }

    private static function enum(BackedEnum|string $value): string
    {
        if ($value instanceof BackedEnum) {
            return Enum::string($value);
        }

        return $value;
    }
}