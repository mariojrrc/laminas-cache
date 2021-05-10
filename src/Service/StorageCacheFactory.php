<?php

namespace Laminas\Cache\Service;

use Interop\Container\ContainerInterface;
use Laminas\Cache\Storage\StorageInterface;
use Laminas\Cache\StorageFactory;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

/**
 * Storage cache factory.
 */
class StorageCacheFactory implements FactoryInterface
{
    use PluginManagerLookupTrait;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->prepareStorageFactory($container);

        $config = $container->get('config');
        $cacheConfig = isset($config['cache']) ? $config['cache'] : [];
        return StorageFactory::factory($cacheConfig);
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, StorageInterface::class);
    }
}
