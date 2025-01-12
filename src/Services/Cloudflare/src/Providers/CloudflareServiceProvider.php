<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Services\Cloudflare\Providers;

use Illuminate\Support\ServiceProvider;
use PHPGenesis\Services\Cloudflare\Console\Commands\UpdateCloudflareDomainContactsCommand;

/** @experimental */
class CloudflareServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->commands([
            UpdateCloudflareDomainContactsCommand::class,
        ]);
    }
}
