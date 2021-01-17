<?php

/**
 * This file is part of the data-extractor-bundle.
 */

namespace Kematjaya\DataExtractorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

/**
 * @package Kematjaya\DataExtractorBundle\DependencyInjection
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class DataExtractorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container) 
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Resources/config'));
        $loader->load('services.yml');
    }
}
