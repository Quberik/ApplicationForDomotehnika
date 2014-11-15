<?php

namespace Test\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * This is the class that validates and merges configuration from your app/config files
 * @package Test\UserBundle\DependencyInjection
 * @author Podluzhnyy Vladimir aka Quber <quber.one@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('avto_user');

        return $treeBuilder;
    }
}
