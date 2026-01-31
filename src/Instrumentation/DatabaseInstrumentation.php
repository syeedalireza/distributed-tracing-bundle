<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Instrumentation;

/**
 * Automatic instrumentation for database queries.
 */
final class DatabaseInstrumentation
{
    private array $queries = [];

    public function startQuery(string $sql): string
    {
        $queryId = uniqid('db_', true);
        
        $this->queries[$queryId] = [
            'sql' => $sql,
            'start' => microtime(true),
        ];

        return $queryId;
    }

    public function endQuery(string $queryId): void
    {
        if (!isset($this->queries[$queryId])) {
            return;
        }

        $this->queries[$queryId]['duration'] = microtime(true) - $this->queries[$queryId]['start'];
    }

    public function getQueries(): array
    {
        return $this->queries;
    }
}
