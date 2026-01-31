<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Instrumentation;

final class CacheInstrumentation
{
    private array $operations = [];

    public function recordCacheHit(string $key): void
    {
        $this->operations[] = [
            'type' => 'hit',
            'key' => $key,
            'timestamp' => microtime(true),
        ];
    }

    public function recordCacheMiss(string $key): void
    {
        $this->operations[] = [
            'type' => 'miss',
            'key' => $key,
            'timestamp' => microtime(true),
        ];
    }

    public function getOperations(): array
    {
        return $this->operations;
    }

    public function getHitRate(): float
    {
        $total = count($this->operations);
        if ($total === 0) {
            return 0.0;
        }

        $hits = count(array_filter($this->operations, fn($op) => $op['type'] === 'hit'));

        return $hits / $total;
    }
}
