# Usage Guide

## Automatic Instrumentation

HTTP requests, database queries, and cache operations are automatically traced.

## Manual Spans

```php
use Syeedalireza\TracingBundle\Tracer\Tracer;

public function __construct(private Tracer $tracer) {}

public function processOrder(): void
{
    $this->tracer->startSpan('process-order', function() {
        // Your business logic
        $this->validateOrder();
        $this->saveOrder();
        $this->sendNotification();
    });
}
```

## Nested Spans

```php
$this->tracer->startSpan('parent-operation', function() {
    $this->tracer->startSpan('child-operation-1', function() {
        // Work
    });
    
    $this->tracer->startSpan('child-operation-2', function() {
        // More work
    });
});
```

## View Traces

Open Jaeger UI: http://localhost:16686
