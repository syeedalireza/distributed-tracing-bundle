<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Tests\Unit\Instrumentation;

use PHPUnit\Framework\TestCase;
use Syeedalireza\TracingBundle\Instrumentation\DatabaseInstrumentation;

final class DatabaseInstrumentationTest extends TestCase
{
    public function testStartAndEndQuery(): void
    {
        $instrumentation = new DatabaseInstrumentation();
        
        $queryId = $instrumentation->startQuery('SELECT * FROM users');
        $instrumentation->endQuery($queryId);

        $queries = $instrumentation->getQueries();
        
        $this->assertCount(1, $queries);
        $this->assertArrayHasKey('sql', $queries[$queryId]);
        $this->assertArrayHasKey('duration', $queries[$queryId]);
    }
}
