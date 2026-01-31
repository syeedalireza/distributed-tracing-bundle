<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Propagation;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Propagation\TraceContext;

final class TraceContextTest extends TestCase
{
    public function testGenerate(): void
    {
        $context = TraceContext::generate();

        $this->assertNotEmpty($context->getTraceId());
        $this->assertNotEmpty($context->getSpanId());
    }

    public function testToHeader(): void
    {
        $context = new TraceContext('trace123', 'span456', '01');
        $header = $context->toHeader();

        $this->assertStringContainsString('trace123', $header);
        $this->assertStringContainsString('span456', $header);
    }

    public function testFromHeader(): void
    {
        $header = '00-trace123-span456-01';
        $context = TraceContext::fromHeader($header);

        $this->assertEquals('trace123', $context->getTraceId());
        $this->assertEquals('span456', $context->getSpanId());
    }
}
