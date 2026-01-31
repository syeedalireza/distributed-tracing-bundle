# Installation

## Requirements
- PHP 8.2+
- Symfony 7.x
- Jaeger or Zipkin (optional, for visualization)

## Install

```bash
composer require syeedalireza/distributed-tracing-bundle
```

## Configure

```yaml
# config/packages/distributed_tracing.yaml
distributed_tracing:
    enabled: true
    service_name: my-app
    exporter: jaeger
    jaeger:
        endpoint: http://localhost:14268/api/traces
```

## Start Jaeger (Docker)

```bash
docker-compose up -d
```

Access Jaeger UI at: http://localhost:16686
