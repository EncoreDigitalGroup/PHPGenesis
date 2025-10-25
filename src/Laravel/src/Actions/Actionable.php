<?php

namespace PHPGenesis\Laravel\Actions;

use Exception;
use Illuminate\Container\Container;
use PHPGenesis\Common\Actions\IAction;
use PHPGenesis\Common\Actions\UnauthorizedAction;
use PHPGenesis\Common\Actions\UnauthorizedActionOverride;
use ReflectionClass;
use ReflectionNamedType;

/** @phpstan-ignore-next-line trait.unused */
trait Actionable
{
    public static function dispatch(mixed ...$params): mixed
    {
        $action = static::make(...$params);

        if ($action instanceof IAction && $action->authorize()) {
            return $action->handle();
        }

        $reflection = new ReflectionClass($action);
        $attributes = $reflection->getAttributes(UnauthorizedActionOverride::class);

        if ($attributes !== []) {
            return $attributes[0]->newInstance()->value;
        }

        throw new UnauthorizedAction;
    }

    public static function make(mixed ...$params): static
    {
        $reflector = new ReflectionClass(static::class);
        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new static;
        }

        $container = Container::getInstance();
        $dependencies = [];
        $paramsIndex = 0;

        /**
         * First attempt to resolve the service class from the container.
         * Then, attempt to use the provided value from the developer.
         * Finally, use the parameter's default value if defined.
         */
        foreach ($constructor->getParameters() as $reflectionParameter) {
            $type = $reflectionParameter->getType();
            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                try {
                    $dependencies[] = $container->make($type->getName());

                    continue;
                } catch (Exception) {
                    // No-op
                }
            }

            if ($paramsIndex < count($params)) {
                $dependencies[] = $params[$paramsIndex];
                $paramsIndex++;

                continue;
            }

            if ($reflectionParameter->isDefaultValueAvailable()) {
                $dependencies[] = $reflectionParameter->getDefaultValue();

                continue;
            }

            // Unable to resolve this parameter. Fallback to direct instantiation.
            return new static(...$params);
        }

        return new static(...$dependencies);
    }

    public function authorize(): bool
    {
        return true;
    }
}
