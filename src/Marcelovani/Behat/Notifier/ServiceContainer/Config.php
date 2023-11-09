<?php

namespace Marcelovani\Behat\Notifier\ServiceContainer;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class Config
{
    const EXTENSION_CONFIG_KEY = 'behat_notifier';
    const CONFIG_CONTAINER_ID = 'behat_notifier.extension.config';

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
    }

    /**
     * Init service container.
     *
     * @param ContainerBuilder $container
     */
    public function loadServices(ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/config'));
        $loader->load('services.xml');
    }
}
