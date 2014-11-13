<?php

/**
 * Author: Podluzhnyy Vladimir aka Quber
 * Contact: quber.one@gmail.com
 * Date & Time: 12.11.2014 / 15:00
 * Filename: Configuration.php
 * Notes: Special for Domotehnika
 */

namespace Test\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * This is the class that validates and merges configuration from your app/config files
 * @package Test\UserBundle\DependencyInjection
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
