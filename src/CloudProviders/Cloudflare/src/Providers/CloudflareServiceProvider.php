<?php

/*
 * Copyright (c) 2024-2025. Encore Digital Group.
 * All Rights Reserved.
 */

namespace PHPGenesis\CloudProviders\Cloudflare\Providers;

use Illuminate\Support\ServiceProvider;
use PHPGenesis\CloudProviders\Cloudflare\Console\Commands\UpdateCloudflareDomainContactsCommand;

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
