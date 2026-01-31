# Distributed Tracing Bundle

OpenTelemetry-based distributed tracing for Symfony with automatic instrumentation for HTTP, Database, and Cache operations.

## Features

- OpenTelemetry SDK integration
- Automatic span creation (HTTP/DB/Cache)
- W3C Trace Context propagation
- Jaeger/Zipkin exporters
- Performance metrics collection
- Custom instrumentation support
- Sampling strategies

## Installation

```bash
composer require syeedalireza/distributed-tracing-bundle
```

## Configuration

```yaml
distributed_tracing:
    enabled: true
    service_name: my-app
    exporter: jaeger
    jaeger:
        endpoint: http://jaeger:14268/api/traces
```

## Usage

```php
// Automatic instrumentation for HTTP requests
// Traces are automatically created and exported

// Custom spans
$tracer->startSpan('my-operation', function() {
    // Your code here
});
```
