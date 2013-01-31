<?php

namespace Armetiz\StatisticBundle\Tests\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;

use Armetiz\StatisticBundle\DependencyInjection\Configuration;

class ConfigurationText extends \PHPUnit_Framework_TestCase {
    private $configuration;
    private $processor;

    public function setUp()
    {
        $this->configuration = new Configuration();
        $this->processor = new Processor();
    }

    public function tearDown()
    {
        unset($this->configuration, $this->processor);
    }
    
    public function testStandardDefinition()
    {
        $configRaw = array(
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
        
        $config = $this->processor->processConfiguration($this->configuration, $configRaw);
        
        $this->assertArrayHasKey("categories", $config);
        $this->assertArrayHasKey("video", $config["categories"]);
        $this->assertArrayHasKey("user", $config["categories"]);
        
        $this->assertEquals(null, $config["categories"]["video"]);
        $this->assertEquals("ACME\Entity\User", $config["categories"]["user"]);
    }
    
    public function testNoDefinition()
    {
        $configRaw = array(
            "armetiz_statistic" => array (),
        );
        
        $config = $this->processor->processConfiguration($this->configuration, $configRaw);
        
        $this->assertArrayHasKey("categories", $config);
        $this->assertArrayHasKey("actions", $config);
        $this->assertArrayHasKey("supports", $config);
        
        $this->assertInternalType('array', $config["categories"]);
        $this->assertInternalType('array', $config["actions"]);
        $this->assertInternalType('array', $config["supports"]);
        
        $this->assertEmpty($config["categories"]);
        $this->assertEmpty($config["actions"]);
        $this->assertEmpty($config["supports"]);
    }
}
