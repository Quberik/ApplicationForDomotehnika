<?php

namespace Test\UserBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class TestUserExtension
 * This is the class that loads and manages your bundle configuration
 * @package Test\UserBundle\DependencyInjection
 * @author Podluzhnyy Vladimir aka Quber <quber.one@gmail.com>
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
