<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Syeedalireza\TracingBundle\Tracer\Tracer;

final class TracingListener
{
    private array $activeSpans = [];

    public function __construct(
        private readonly Tracer $tracer,
    ) {
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        $spanName = sprintf('%s %s', $request->getMethod(), $request->getPathInfo());
        
        // Start HTTP request span would go here
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        // End HTTP request span would go here
    }
}
