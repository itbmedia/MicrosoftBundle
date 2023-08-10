<?php
namespace Logy\Bundle\MicrosoftBundle\DependencyInjection;

use App\MicrosoftBundle\Service\MicrosoftServiceInterface;
use Logy\Bundle\MicrosoftBundle\Service\DataSerializerInterface;
use Logy\Bundle\MicrosoftBundle\Service\Graph\MicrosoftGraphClient;
use Logy\Bundle\MicrosoftBundle\Service\Graph\MicrosoftGraphClientInterface;
use Logy\Bundle\MicrosoftBundle\Service\MicrosoftServiceInterface as ServiceMicrosoftServiceInterface;
use Logy\Bundle\MicrosoftBundle\Service\OAuth\MicrosoftOAuthClientInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;


class LogyMicrosoftExtension extends Extension {
    
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.xml');

        if (empty($config['server_base_url']) || empty($config['tenant_id']) || empty($config['client_id']) || empty($config['client_secret'])) {
            $e = new InvalidConfigurationException('You must configure "tenant_id", "client_id" and "client_secret".');
            $e->setPath('logy_microsoft_bundle');
            throw $e;
        }

        $container->setParameter('logy.microsoft.config.server', $config['server_base_url']);
        $container->setParameter('logy.microsoft.config.tenant', $config['tenant_id']);
        $container->setParameter('logy.microsoft.config.client', $config['client_id']);
        $container->setParameter('logy.microsoft.config.secret', $config['client_secret']);

        // $container->setParameter('lexik_jwt_authentication.token_ttl', $config['token_ttl']);
        $container->setAlias(DataSerializerInterface::class, 'logy.microsoft.data.serializer');
        $container->setAlias(ServiceMicrosoftServiceInterface::class, 'logy.microsoft.service');
        $container->setAlias(MicrosoftGraphClientInterface::class, 'logy.microsoft.client.graph');

    }

    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/';
    }

}