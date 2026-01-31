<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Sampler;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Sampler\ProbabilitySampler;

final class ProbabilitySamplerTest extends TestCase
{
    public function testAlwaysSample(): void
    {
        $sampler = new ProbabilitySampler(1.0);

        $this->assertTrue($sampler->shouldSample());
    }

    public function testNeverSample(): void
    {
        $sampler = new ProbabilitySampler(0.0);

        $this->assertFalse($sampler->shouldSample());
    }

    public function testInvalidProbabilityThrows(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new ProbabilitySampler(1.5);
    }
}
