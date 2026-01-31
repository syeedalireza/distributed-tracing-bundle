<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Metrics;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Metrics\MetricsCollector;

final class MetricsCollectorTest extends TestCase
{
    public function testRecordAndGetMetrics(): void
    {
        $collector = new MetricsCollector();
        
        $collector->recordSpanDuration('db-query', 0.5);
        $collector->recordSpanDuration('db-query', 0.3);

        $average = $collector->getAverage('db-query');

        $this->assertEquals(0.4, $average);
    }

    public function testTracksMinMax(): void
    {
        $collector = new MetricsCollector();
        
        $collector->recordSpanDuration('http-request', 1.0);
        $collector->recordSpanDuration('http-request', 0.5);
        $collector->recordSpanDuration('http-request', 2.0);

        $metrics = $collector->getMetrics()['http-request'];

        $this->assertEquals(0.5, $metrics['min']);
        $this->assertEquals(2.0, $metrics['max']);
    }
}
