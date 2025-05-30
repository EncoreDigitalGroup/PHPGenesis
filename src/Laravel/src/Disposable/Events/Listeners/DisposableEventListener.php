<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Laravel\Disposable\Events\Listeners;

use Illuminate\Foundation\Events\Terminating;
use PHPGenesis\Laravel\Disposable\Events\DisposeEvent;
use PHPGenesis\Laravel\Disposable\Interfaces\IDisposable;
use ReflectionClass;
use ReflectionProperty;

class DisposableEventListener
{
    public function handle(DisposeEvent|Terminating $event): void
    {
        $this->cleanupDisposableClasses();
    }

    protected function cleanupDisposableClasses(): void
    {
        $allClasses = get_declared_classes();

        foreach ($allClasses as $className) {
            if (in_array(IDisposable::class, class_implements($className))) {
                $reflection = new ReflectionClass($className);

                foreach ($reflection->getProperties(ReflectionProperty::IS_STATIC) as $property) {
                    $reflection->setStaticPropertyValue($property->getName(), null);
                }
            }
        }
    }
}
