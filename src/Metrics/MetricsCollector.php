<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Metrics;

final class MetricsCollector
{
    private array $metrics = [];

    public function recordSpanDuration(string $spanName, float $duration): void
    {
        if (!isset($this->metrics[$spanName])) {
            $this->metrics[$spanName] = [
                'count' => 0,
                'total_duration' => 0.0,
                'min' => PHP_FLOAT_MAX,
                'max' => 0.0,
            ];
        }

        $this->metrics[$spanName]['count']++;
        $this->metrics[$spanName]['total_duration'] += $duration;
        $this->metrics[$spanName]['min'] = min($this->metrics[$spanName]['min'], $duration);
        $this->metrics[$spanName]['max'] = max($this->metrics[$spanName]['max'], $duration);
    }

    public function getMetrics(): array
    {
        return $this->metrics;
    }

    public function getAverage(string $spanName): float
    {
        if (!isset($this->metrics[$spanName])) {
            return 0.0;
        }

        $metric = $this->metrics[$spanName];

        return $metric['total_duration'] / $metric['count'];
    }
}
