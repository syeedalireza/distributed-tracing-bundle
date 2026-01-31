<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Instrumentation;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Instrumentation\CacheInstrumentation;

final class CacheInstrumentationTest extends TestCase
{
    public function testRecordCacheHit(): void
    {
        $instrumentation = new CacheInstrumentation();
        $instrumentation->recordCacheHit('user:123');

        $this->assertCount(1, $instrumentation->getOperations());
    }

    public function testGetHitRate(): void
    {
        $instrumentation = new CacheInstrumentation();
        $instrumentation->recordCacheHit('key1');
        $instrumentation->recordCacheMiss('key2');
        $instrumentation->recordCacheHit('key3');

        $this->assertEquals(2/3, $instrumentation->getHitRate(), '', 0.01);
    }
}
