<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Common\Events\Listeners;

use PHPGenesis\Common\Events\DisposeEvent;
use PHPGenesis\Common\Interfaces\IDisposable;
use ReflectionClass;
use ReflectionProperty;

class DisposableEventListener
{
    public function handle(DisposeEvent $event): void
    {
        $this->cleanupDisposableClasses();
    }

    /**
     * Find and unset static properties of IDisposable classes.
     */
    protected function cleanupDisposableClasses(): void
    {
        $allClasses = get_declared_classes();

        foreach ($allClasses as $className) {
            if (in_array(IDisposable::class, class_implements($className))) {
                $reflection = new ReflectionClass($className);

                // Iterate through static properties and set them to null
                foreach ($reflection->getProperties(ReflectionProperty::IS_STATIC) as $property) {
                    $reflection->setStaticPropertyValue($property->getName(), null);
                }
            }
        }
    }
}
