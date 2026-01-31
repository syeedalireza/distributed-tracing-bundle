<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

final class TracingExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('tracing.enabled', $config['enabled']);
        $container->setParameter('tracing.service_name', $config['service_name']);
        $container->setParameter('tracing.exporter', $config['exporter']);
    }

    public function getAlias(): string
    {
        return 'distributed_tracing';
    }
}
