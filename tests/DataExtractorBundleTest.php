<?php

/**
 * This file is part of the data-extractor-bundle.
 */

namespace Kematjaya\DataExtractorBundle\Tests;

use Kematjaya\DataExtractorBundle\Extractor\EntityExtractorInterface;
use Kematjaya\DataExtractorBundle\Manager\ExtractorManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @package Kematjaya\DataExtractorBundle\Tests
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class DataExtractorBundleTest extends WebTestCase
{
    public static function getKernelClass() 
    {
        return AppKernelTest::class;
    }
    
    public function testInstanceClass():ContainerInterface
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $this->assertInstanceOf(ContainerInterface::class, $container);
        
        return $container;
    }
    
    /**
     * @depends testInstanceClass
     * @param ContainerInterface $container
     * @return ExtractorManagerInterface
     */
    public function testEctractorInstance(ContainerInterface $container): ExtractorManagerInterface
    {
        $this->assertTrue($container->has('kmj.extractor_manager'));
        
        return $container->get('kmj.extractor_manager');
    }
    
    /**
     * @depends testEctractorInstance
     * @param ExtractorManagerInterface $extractor
     */
    public function testExtract(ExtractorManagerInterface $extractor)
    {
        $entityExtractor = $this->createConfiguredMock(EntityExtractorInterface::class, [
            'extract' => [
                'test' => 'test replace'
            ]
        ]);
        
        $content = '<h1>${test}</h1>';
        $result = $extractor->extractToString($content, new ObjectTest(), $entityExtractor);
        $this->assertEquals("<h1>test replace</h1>", $result);
    }
}
