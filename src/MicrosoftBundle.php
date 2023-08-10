<?php
namespace Logy\Bundle\MicrosoftBundle;

use Logy\Bundle\MicrosoftBundle\DependencyInjection\LogyMicrosoftExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MicrosoftBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->loadFromExtension('framework', array(
            'serializer' => array(
                'enabled' => true
            ),
        ));

        $container->prependExtensionConfig('framework', array(
            'http_client' => array(
               'scoped_clients' => array(
                    'microsoft.graph.client' => array(
                        'base_uri' => 'https://graph.microsoft.com/v1.0/',
                        'headers' => array(
                            'Content-Type' => 'application/json'
                        )
                    )
               ) 
            )
        ));
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new LogyMicrosoftExtension();
        }
        return $this->extension;
    }
}