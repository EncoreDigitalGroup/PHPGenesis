<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Rights Reserved.
 */

declare(strict_types=1);

namespace PHPGenesis\Laravel\PHPStan\Rules\Eloquent\Scopes;

use ReflectionParameter;
use Illuminate\Database\Eloquent\Builder;
use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\Generic\TemplateTypeMap;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use ReflectionMethod;

/** @internal */
readonly class EloquentScopeMethodReflection implements MethodReflection
{
    public function __construct(
        private string           $methodName,
        private ClassReflection  $classReflection,
        private ReflectionMethod $scopeMethod
    ) {}

    public function getDeclaringClass(): ClassReflection
    {
        return $this->classReflection;
    }

    public function isStatic(): bool
    {
        return true;
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function isPublic(): bool
    {
        return true;
    }

    public function getDocComment(): ?string
    {
        return $this->scopeMethod->getDocComment() ?: null;
    }

    public function getName(): string
    {
        return $this->methodName;
    }

    public function getPrototype(): ClassMemberReflection
    {
        return $this;
    }

    public function getVariants(): array
    {
        $parameters = $this->getParametersFromScopeMethod();

        // Return type is Builder<ModelClass>
        $modelType = new ObjectType($this->classReflection->getName());
        $returnType = new GenericObjectType(
            Builder::class,
            [$modelType]
        );

        return [
            new FunctionVariant(
                TemplateTypeMap::createEmpty(),
                null,
                $parameters,
                false,
                $returnType
            ),
        ];
    }

    public function isDeprecated(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getDeprecatedDescription(): ?string
    {
        return null;
    }

    public function isFinal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function isInternal(): TrinaryLogic
    {
        return TrinaryLogic::createNo();
    }

    public function getThrowType(): ?Type
    {
        return null;
    }

    public function hasSideEffects(): TrinaryLogic
    {
        return TrinaryLogic::createMaybe();
    }

    /**
     * Extract parameters from the scope method, excluding the first parameter (Builder $query).
     *
     * @return list<ParameterReflection>
     */
    private function getParametersFromScopeMethod(): array
    {
        $parameters = $this->scopeMethod->getParameters();

        // Remove the first parameter (Builder $query)
        array_shift($parameters);

        return array_values(array_map(
            fn(ReflectionParameter $param): ParameterReflection => new EloquentScopeParameterReflection($param),
            $parameters
        ));
    }
}