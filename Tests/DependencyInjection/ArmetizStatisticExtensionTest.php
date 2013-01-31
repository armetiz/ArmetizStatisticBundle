<?php

namespace Armetiz\StatisticBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Armetiz\StatisticBundle\DependencyInjection\ArmetizStatisticExtension;

class ArmetizStatisticExtensionTest extends \PHPUnit_Framework_TestCase {
    private $container;
    private $extension;

    public function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new ArmetizStatisticExtension();
    }

    public function tearDown()
    {
        unset($this->container, $this->extension);
    }
    
    public function testContextDefinition()
    {
        $config = array(
            "armetiz_statistic" => array (
                "categories" => array (
                    "video" => null,
                    "user" => "ACME\Entity\User",
                ),
                "actions" => array (
                    "view" => true,
                    "share" => true,
                    "like" => true,
                ),
                "supports" => array (
                    "iphone" => true,
                    "desktop" => true,
                ),
            ),
        );
        
        $this->extension->load($config, $this->container);
    }
}
