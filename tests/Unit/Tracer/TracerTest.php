<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Tracer;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Tracer\Tracer;

final class TracerTest extends TestCase
{
    public function testStartSpan(): void
    {
        $tracer = new Tracer();
        
        $result = $tracer->startSpan('test-operation', function() {
            return 'result';
        });

        $this->assertEquals('result', $result);
        $this->assertCount(1, $tracer->getSpans());
    }

    public function testSpanContainsMetadata(): void
    {
        $tracer = new Tracer();
        
        $tracer->startSpan('db-query', function() {
            usleep(1000);
        });

        $spans = $tracer->getSpans();
        $this->assertArrayHasKey('name', $spans[0]);
        $this->assertArrayHasKey('duration', $spans[0]);
        $this->assertEquals('db-query', $spans[0]['name']);
    }
}
