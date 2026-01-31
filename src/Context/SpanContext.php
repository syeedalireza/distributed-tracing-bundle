<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Context;

use Syeedalireza\TracingBundle\Span\Span;

final class SpanContext
{
    private ?Span $currentSpan = null;

    public function setCurrentSpan(Span $span): void
    {
        $this->currentSpan = $span;
    }

    public function getCurrentSpan(): ?Span
    {
        return $this->currentSpan;
    }

    public function clear(): void
    {
        $this->currentSpan = null;
    }
}
