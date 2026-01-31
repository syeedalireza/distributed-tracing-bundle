<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('distributed_tracing');

        $treeBuilder->getRootNode()
            ->children()
                ->booleanNode('enabled')->defaultTrue()->end()
                ->scalarNode('service_name')->defaultValue('symfony-app')->end()
                ->scalarNode('exporter')->defaultValue('jaeger')->end()
                ->arrayNode('jaeger')
                    ->children()
                        ->scalarNode('endpoint')->defaultValue('http://localhost:14268/api/traces')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
