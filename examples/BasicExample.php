<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Syeedalireza\TracingBundle\Tracer\Tracer;

echo "=== Distributed Tracing Example ===\n\n";

$tracer = new Tracer();

$tracer->startSpan('http-request', function() use ($tracer) {
    $tracer->startSpan('database-query', function() {
        usleep(50000); // Simulate DB query
    });
    
    $tracer->startSpan('cache-read', function() {
        usleep(10000); // Simulate cache
    });
});

echo "Spans recorded: " . count($tracer->getSpans()) . "\n";
foreach ($tracer->getSpans() as $span) {
    echo "- {$span['name']}: " . round($span['duration'] * 1000, 2) . "ms\n";
}

echo "\n✅ Tracing works!\n";
