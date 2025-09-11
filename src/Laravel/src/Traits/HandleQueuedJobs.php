<?php

/*
 * Copyright (c) 2025. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\Laravel\Traits;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Throwable;

/** @phpstan-ignore-next-line trait.unused */
trait HandleQueuedJobs
{
    use InteractsWithQueue;

    private const int DEFAULT_BACKOFF = 30;

    protected function releaseWithBackoffOrFail(): void
    {
        try {
            $this->releaseWithBackoff();
        } catch (Throwable $throwable) {
            $this->fail($throwable);
        }
    }

    protected function releaseWithBackoff(): void
    {
        if ($this->shouldStopRetrying()) {
            $this->fail();

            return;
        }

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

    protected function shouldStopRetrying(): bool
    {
        if ($this->hasExceededMaxTries()) {
            return true;
        }

        return (bool) $this->hasExceededRetryUntil();
    }

    private function hasExceededMaxTries(): bool
    {
        if (property_exists($this, "tries") && is_int($this->tries)) {
            return $this->attempts() >= $this->tries;
        }

        if (method_exists($this, "maxTries")) {
            $maxTries = $this->maxTries();
            if (is_int($maxTries)) {
                return $this->attempts() >= $maxTries;
            }
        }

        return false;
    }

    private function hasExceededRetryUntil(): bool
    {
        if (method_exists($this, "retryUntil")) {
            $retryUntil = $this->job->retryUntil();
            if (is_int($retryUntil)) {
                $retryUntilCarbon = Carbon::createFromTimestamp($retryUntil);

                return Carbon::now()->gte($retryUntilCarbon);
            }
        }

        return false;
    }
}