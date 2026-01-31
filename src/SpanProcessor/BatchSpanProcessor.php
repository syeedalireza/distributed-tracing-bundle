<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\SpanProcessor;

use Syeedalireza\TracingBundle\Span\Span;
use Syeedalireza\TracingBundle\Exporter\JaegerExporter;

final class BatchSpanProcessor
{
    private array $spans = [];

    public function __construct(
        private readonly JaegerExporter $exporter,
        private readonly int $batchSize = 100,
    ) {
    }

    public function process(Span $span): void
    {
        $this->spans[] = $span->toArray();

        if (count($this->spans) >= $this->batchSize) {
            $this->flush();
        }
    }

    public function flush(): void
    {
        if (empty($this->spans)) {
            return;
        }

        $this->exporter->export($this->spans);
        $this->spans = [];
    }

    public function __destruct()
    {
        $this->flush();
    }
}
