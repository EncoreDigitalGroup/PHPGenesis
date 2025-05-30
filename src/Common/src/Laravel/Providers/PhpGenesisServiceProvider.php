<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\Common\Laravel\Providers;

use Illuminate\Foundation\Events\Terminating;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use PHPGenesis\Common\Events\DisposeEvent;
use PHPGenesis\Common\Events\Listeners\DisposableEventListener;

class PhpGenesisServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . "/../Config/phpgenesis.php", "phpgenesis");
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . "/../Config/phpgenesis.php" => config_path("phpgenesis.php"),
        ]);

        Event::listen(Terminating::class, DisposableEventListener::class);
        Event::listen(DisposeEvent::class, DisposableEventListener::class);

        Queue::after(function (JobProcessed $event): void {
            DisposeEvent::dispatch();
        });
    }
}
