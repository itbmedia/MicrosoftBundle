<?php
namespace Logy\Bundle\MicrosoftBundle\DependencyInjection;

use Symfony\Component\Config\Definition\BaseNode;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('logy_microsoft');
        
        $treeBuilder
            ->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('server_base_url')
                    ->info("The base url of the server")
                    ->example("https://localhost:8000")
                    ->defaultNull()
                ->end()
                ->scalarNode('tenant_id')
                    ->info("This is the tenant id of your microsoft tenant")
                    ->example("00000000-0000-0000-0000-000000000000")
                    ->defaultNull()
                ->end()
                ->scalarNode("client_id")
                    ->info("This is the client id of your microsoft azure application")
                    ->example("00000000-0000-0000-0000-000000000000")
                    ->defaultNull()
                ->end()
                ->scalarNode('client_secret')
                    ->info("This is the client secret of your microsoft azure application")
                    ->example("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                    ->defaultNull()
                ->end()
            ->end();

        return $treeBuilder;
    }
}