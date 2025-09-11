<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Laravel\Traits;

use Illuminate\Queue\InteractsWithQueue;

/** @phpstan-ignore-next-line trait.unused */
trait HandleQueuedJobs
{
    use InteractsWithQueue;

    private const int DEFAULT_BACKOFF = 30;

    protected function releaseWithBackoff(): void
    {
        $backoff = self::DEFAULT_BACKOFF;
        if (method_exists($this, "backoff")) {
            $backoff = $this->backoff();
        }

        $attempt = $this->attempts();

        if (is_int($backoff)) {
            $delay = $backoff;
        } elseif (is_array($backoff)) {
            $index = $attempt - 1;
            $delay = $backoff[$index] ?? end($backoff);
            if (!is_int($delay)) {
                $delay = self::DEFAULT_BACKOFF;
            }
        } else {
            $delay = self::DEFAULT_BACKOFF;
        }

        $this->release($delay);
    }
}