<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Formatter;

use Syeedalireza\TracingBundle\Span\Span;

final class SpanFormatter
{
    public function formatForJaeger(Span $span): array
    {
        $data = $span->toArray();

        return [
            'traceId' => $this->generateTraceId(),
            'spanId' => $data['id'],
            'operationName' => $data['name'],
            'startTime' => (int) ($data['start_time'] * 1000000),
            'duration' => (int) ($data['duration'] * 1000000),
            'tags' => $data['attributes'] ?? [],
        ];
    }

    public function formatForZipkin(Span $span): array
    {
        $data = $span->toArray();

        return [
            'id' => $data['id'],
            'name' => $data['name'],
            'timestamp' => (int) ($data['start_time'] * 1000000),
            'duration' => (int) ($data['duration'] * 1000000),
            'tags' => $data['attributes'] ?? [],
        ];
    }

    private function generateTraceId(): string
    {
        return bin2hex(random_bytes(16));
    }
}
