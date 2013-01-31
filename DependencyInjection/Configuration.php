<?php

namespace Armetiz\StatisticBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('armetiz_statistic');

        $rootNode
            ->children()
                ->arrayNode("categories")
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode("actions")
                    ->useAttributeAsKey('name')
                    ->prototype('boolean')->end()
                ->end()
                ->arrayNode("supports")
                    ->useAttributeAsKey('name')
                    ->prototype('boolean')->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
