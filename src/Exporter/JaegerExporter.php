<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Exporter;

final class JaegerExporter
{
    public function __construct(
        private readonly string $endpoint = 'http://localhost:14268/api/traces',
    ) {
    }

    public function export(array $spans): void
    {
        $payload = json_encode(['spans' => $spans]);
        
        $ch = curl_init($this->endpoint);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_exec($ch);
        curl_close($ch);
    }
}
