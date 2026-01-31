<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Propagation;

/**
 * W3C Trace Context implementation.
 */
final class TraceContext
{
    public function __construct(
        private readonly string $traceId,
        private readonly string $spanId,
        private readonly string $traceFlags = '01',
    ) {
    }

    public function getTraceId(): string
    {
        return $this->traceId;
    }

    public function getSpanId(): string
    {
        return $this->spanId;
    }

    public function toHeader(): string
    {
        return sprintf('00-%s-%s-%s', $this->traceId, $this->spanId, $this->traceFlags);
    }

    public static function fromHeader(string $header): self
    {
        $parts = explode('-', $header);
        
        return new self($parts[1] ?? '', $parts[2] ?? '', $parts[3] ?? '01');
    }

    public static function generate(): self
    {
        return new self(
            bin2hex(random_bytes(16)),
            bin2hex(random_bytes(8)),
            '01'
        );
    }
}
