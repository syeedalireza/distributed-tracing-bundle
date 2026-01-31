# Best Practices

## Span Naming

Use clear, hierarchical names:

```php
// Good
$tracer->startSpan('http.request.POST./api/users', ...)

// Bad
$tracer->startSpan('request', ...)
```

## Attributes

Add meaningful attributes to spans:

```php
$tracer->startSpan('db.query', function() use ($sql, $params) {
    // Add attributes: sql, parameters, table name
});
```

## Sampling

Don't trace every request in production:

```yaml
distributed_tracing:
    sampling:
        rate: 0.1  # Trace 10% of requests
```

## Performance

- Keep spans lightweight
- Avoid tracing in tight loops
- Use async exporters
- Set reasonable timeout for exporters

## Security

- Don't include sensitive data in spans
- Sanitize SQL queries
- Filter request/response bodies
