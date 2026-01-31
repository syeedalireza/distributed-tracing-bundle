<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Exporter;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Exporter\ZipkinExporter;

final class ZipkinExporterTest extends TestCase
{
    public function testExporterCreation(): void
    {
        $exporter = new ZipkinExporter('http://localhost:9411/api/v2/spans');
        
        $this->assertInstanceOf(ZipkinExporter::class, $exporter);
    }
}
