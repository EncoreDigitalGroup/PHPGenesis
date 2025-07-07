<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Laravel\Disposable\Events\Listeners;

use Exception;
use Illuminate\Foundation\Events\Terminating;
use PHPGenesis\Laravel\Disposable\Events\DisposeEvent;
use PHPGenesis\Laravel\Disposable\Interfaces\IDisposable;

class DisposableEventListener
{
    public function handle(DisposeEvent|Terminating $event): void
    {
        $this->cleanupDisposableClasses();
    }

    protected function cleanupDisposableClasses(): void
    {
        $allClasses = get_declared_classes();

        /** @var class-string $class */
        foreach ($allClasses as $class) {
            if (in_array(IDisposable::class, class_implements($class))) {
                try {
                    $class::dispose();
                } catch (Exception) {
                    //No-op
                }
            }
        }
    }
}
