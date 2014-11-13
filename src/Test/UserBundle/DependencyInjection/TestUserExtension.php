<?php

/**
 * Author: Podluzhnyy Vladimir aka Quber
 * Contact: quber.one@gmail.com
 * Date & Time: 12.11.2014 / 15:00
 * Filename: TestUserExtenshion.php
 * Notes: Special for Domotehnika
 */

namespace Test\UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class TestUserExtension
 * This is the class that loads and manages your bundle configuration
 * @package Test\UserBundle\DependencyInjection
 */
class TestUserExtension extends Extension
{
    /**
     * {@inheritDoc}
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
