<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

declare(strict_types=1);

namespace PHPGenesis\Laravel\PHPStan\Rules\Eloquent\Scopes;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\ShouldNotHappenException;
use ReflectionAttribute;
use ReflectionMethod;

/**
 * PHPStan extension to recognize Laravel's #[Scope] attribute on Eloquent models.
 *
 * This extension allows PHPStan to understand that methods annotated with the #[Scope]
 * attribute can be called statically on Eloquent models, even though they are defined
 * as instance methods.
 *
 * Example:
 * ```php
 * class User extends Model
 * {
 *     #[Scope]
 *     public function active(Builder $query): Builder
 *     {
 *         return $query->where('is_active', true);
 *     }
 * }
 *
 * // This will now be recognized by PHPStan:
 * User::active()->get();
 * ```
 */
readonly class EloquentScopeAttributeExtension implements MethodsClassReflectionExtension
{
    public function __construct(
        private ReflectionProvider $reflectionProvider
    ) {}

    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        // Only process Eloquent models
        if (!$this->reflectionProvider->hasClass(Model::class)) {
            return false;
        }

        $modelReflection = $this->reflectionProvider->getClass(Model::class);
        if (!$classReflection->isSubclassOfClass($modelReflection) && $classReflection->getName() !== Model::class) {
            return false;
        }

        return $this->findScopeMethod($classReflection, $methodName) instanceof ReflectionMethod;
    }

    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        $scopeMethod = $this->findScopeMethod($classReflection, $methodName);

        if (!$scopeMethod instanceof ReflectionMethod) {
            throw new ShouldNotHappenException(
                "Scope method {$methodName} not found on {$classReflection->getName()}"
            );
        }

        return new EloquentScopeMethodReflection(
            $methodName,
            $classReflection,
            $scopeMethod
        );
    }

    /** Find a method on the class that has the #[Scope] attribute. */
    private function findScopeMethod(ClassReflection $classReflection, string $methodName): ?ReflectionMethod
    {
        $nativeReflection = $classReflection->getNativeReflection();

        if (!$nativeReflection->hasMethod($methodName)) {
            return null;
        }

        $method = $nativeReflection->getMethod($methodName);
        $attributes = $method->getAttributes(Scope::class, ReflectionAttribute::IS_INSTANCEOF);

        if (count($attributes) === 0) {
            return null;
        }

        return $method;
    }
}