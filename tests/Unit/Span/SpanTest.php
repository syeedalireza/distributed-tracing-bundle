<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Span;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Span\Span;

final class SpanTest extends TestCase
{
    public function testSpanCreation(): void
    {
        $span = new Span('span-123', 'test-operation');

        $this->assertGreaterThan(0, $span->getDuration());
    }

    public function testSetAttribute(): void
    {
        $span = new Span('span-123', 'db-query');
        $span->setAttribute('db.statement', 'SELECT * FROM users');
        $span->end();

        $array = $span->toArray();
        $this->assertArrayHasKey('attributes', $array);
        $this->assertEquals('SELECT * FROM users', $array['attributes']['db.statement']);
    }

    public function testSpanWithParent(): void
    {
        $span = new Span('child-123', 'child-op', 'parent-123');
        $array = $span->toArray();

        $this->assertEquals('parent-123', $array['parent_id']);
    }
}
