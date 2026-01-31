<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Exporter;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Exporter\JaegerExporter;

final class JaegerExporterTest extends TestCase
{
    public function testExporterCreation(): void
    {
        $exporter = new JaegerExporter('http://localhost:14268/api/traces');
        
        $this->assertInstanceOf(JaegerExporter::class, $exporter);
    }

    public function testExportSpans(): void
    {
        $exporter = new JaegerExporter();
        
        // This would normally send to Jaeger, but in tests we just verify it doesn't crash
        $exporter->export([
            ['name' => 'test-span', 'duration' => 0.5],
        ]);

        $this->assertTrue(true);
    }
}
