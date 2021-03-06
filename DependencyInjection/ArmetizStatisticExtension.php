<?php

namespace Armetiz\StatisticBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ArmetizStatisticExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        
        $allowedCategories = array ();
        
        foreach ($config["categories"] as $key => $category) {
            if ($category) {
                $allowedCategories[$key] = new Reference($category["service"]);
            }
            else {
                $allowedCategories[$key] = null;
            }                
        }
        
        $allowedActions = array ();
        
        foreach ($config["actions"] as $action => $enabled) {
            if ($enabled) {
                $allowedActions[] = $action;
            }
        }
        
        $allowedSupports = array ();
        
        foreach ($config["supports"] as $support => $enabled) {
            if ($enabled) {
                $allowedSupports[] = $support;
            }
        }
        
        $statisticService = $container->getDefinition("armetiz.statistic.manager.tracker");
        $statisticService->addArgument($allowedCategories);
        $statisticService->addArgument($allowedActions);
        $statisticService->addArgument($allowedSupports);
    }
}
