<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\SpanProcessor;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Exporter\JaegerExporter;
use Syeedalireza\TracingBundle\Span\Span;
use Syeedalireza\TracingBundle\SpanProcessor\BatchSpanProcessor;

final class BatchSpanProcessorTest extends TestCase
{
    public function testProcessBatchesSpans(): void
    {
        $exporter = $this->createMock(JaegerExporter::class);
        $exporter->expects($this->once())->method('export');

        $processor = new BatchSpanProcessor($exporter, batchSize: 2);

        $span1 = new Span('span-1', 'op-1');
        $span2 = new Span('span-2', 'op-2');

        $processor->process($span1);
        $processor->process($span2); // Should trigger flush

        $this->assertTrue(true);
    }
}
