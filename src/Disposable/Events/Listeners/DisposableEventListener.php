<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace Disposable\Events\Listeners;

use Disposable\Events\DisposeEvent;
use Disposable\Interfaces\IDisposable;
use Illuminate\Foundation\Events\Terminating;
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
