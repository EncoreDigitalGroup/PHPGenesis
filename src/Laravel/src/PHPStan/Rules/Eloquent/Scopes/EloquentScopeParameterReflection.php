<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Laravel\PHPStan\Rules\Eloquent\Scopes;

use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\PassedByReference;
use PHPStan\Type\ArrayType;
use PHPStan\Type\BooleanType;
use PHPStan\Type\Constant\ConstantBooleanType;
use PHPStan\Type\Constant\ConstantFloatType;
use PHPStan\Type\Constant\ConstantIntegerType;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use ReflectionNamedType;
use ReflectionParameter;

/** @internal */
readonly class EloquentScopeParameterReflection implements ParameterReflection
{
    public function __construct(private ReflectionParameter $parameter) {}

    public function getName(): string
    {
        return $this->parameter->getName();
    }

    public function isOptional(): bool
    {
        return $this->parameter->isOptional();
    }

    public function getType(): Type
    {
        $reflectionType = $this->parameter->getType();

        if ($reflectionType instanceof ReflectionNamedType) {
            $typeName = $reflectionType->getName();

            // Handle built-in types
            $type = match ($typeName) {
                "string" => new StringType,
                "int" => new IntegerType,
                "float" => new FloatType,
                "bool" => new BooleanType,
                "array" => new ArrayType(
                    new MixedType,
                    new MixedType
                ),
                "mixed" => new MixedType,
                default => new ObjectType($typeName),
            };

            if ($reflectionType->allowsNull()) {
                return TypeCombinator::addNull($type);
            }

            return $type;
        }

        return new MixedType;
    }

    public function passedByReference(): PassedByReference
    {
        return PassedByReference::createNo();
    }

    public function isVariadic(): bool
    {
        return $this->parameter->isVariadic();
    }

    public function getDefaultValue(): ?Type
    {
        if (!$this->parameter->isDefaultValueAvailable()) {
            return null;
        }

        $defaultValue = $this->parameter->getDefaultValue();

        return match (true) {
            is_string($defaultValue) => new ConstantStringType($defaultValue),
            is_int($defaultValue) => new ConstantIntegerType($defaultValue),
            is_float($defaultValue) => new ConstantFloatType($defaultValue),
            is_bool($defaultValue) => new ConstantBooleanType($defaultValue),
            is_null($defaultValue) => new NullType,
            default => null,
        };
    }
}