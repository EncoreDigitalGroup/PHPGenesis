<?php
/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\OpenFeature;

use OpenFeature\interfaces\flags\EvaluationContext;
use OpenFeature\OpenFeatureAPI;

/**
 * @api
 * @experimental
 */
class OpenFeature
{
    public static function bool(string $flagKey, bool $defaultValue = false, ?EvaluationContext $context = null): bool
    {
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveBooleanValue($flagKey, $defaultValue, $context)->getValue();

        if (is_bool($value)) {
            return $value;
        }

        return $defaultValue;
    }

    public static function string(string $flagKey, string $defaultValue = '', ?EvaluationContext $context = null): string
    {
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveStringValue($flagKey, $defaultValue, $context)->getValue();

        if (is_string($value)) {
            return $value;
        }

        return $defaultValue;
    }

    public static function int(string $flagKey, int $defaultValue = 0, ?EvaluationContext $context = null): int
    {
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveIntegerValue($flagKey, $defaultValue, $context)->getValue();

        if (is_int($value)) {
            return $value;
        }

        return $defaultValue;
    }

    public static function float(string $flagKey, float $defaultValue = 0.00, ?EvaluationContext $context = null): float
    {
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveFloatValue($flagKey, $defaultValue, $context)->getValue();

        if (is_float($value)) {
            return $value;
        }

        return $defaultValue;
    }

    public static function object(string $flagKey, array $defaultValue = [], ?EvaluationContext $context = null): object|array
    {
        $api = OpenFeatureAPI::getInstance();
        $value = $api->getProvider()->resolveObjectValue($flagKey, $defaultValue, $context)->getValue();

        if (is_object($value)) {
            return $value;
        }

        return $defaultValue;
    }
}