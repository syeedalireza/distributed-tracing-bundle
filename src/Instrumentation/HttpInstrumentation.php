<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Instrumentation;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

final class HttpInstrumentation
{
    private array $activeSpans = [];

    public function onRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $spanId = uniqid('http_', true);
        
        $this->activeSpans[$spanId] = [
            'method' => $request->getMethod(),
            'uri' => $request->getRequestUri(),
            'start' => microtime(true),
        ];
    }

    public function onResponse(ResponseEvent $event): void
    {
        foreach ($this->activeSpans as $spanId => $span) {
            $duration = microtime(true) - $span['start'];
            // Export span to backend
        }
        
        $this->activeSpans = [];
    }
}
