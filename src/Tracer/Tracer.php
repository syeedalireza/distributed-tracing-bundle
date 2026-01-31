<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tracer;

final class Tracer
{
    private array $spans = [];

    public function startSpan(string $name, callable $callback): mixed
    {
        $spanId = uniqid('span_', true);
        $start = microtime(true);
        
        try {
            $result = $callback();
            return $result;
        } finally {
            $duration = microtime(true) - $start;
            $this->spans[] = [
                'id' => $spanId,
                'name' => $name,
                'duration' => $duration,
            ];
        }
    }

    public function getSpans(): array
    {
        return $this->spans;
    }
}
