<?php

namespace Marcelovani\Behat\Notifier\ServiceContainer;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * This class sends notifications to various channels
 */
final class NotifierExtension implements Extension
{
    /**
     * Constructor: init extension
     */
    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigKey()
    {
        return Config::EXTENSION_CONFIG_KEY;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $builder->children()->scalarNode('screenshotExtension');
        $builder->children()->arrayNode('notifiers')
            ->info('Custom classes that implements notifiers')
            ->normalizeKeys(false)
            ->useAttributeAsKey('name')
            ->prototype('variable')->end()
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $extensionConfig = new Config($config);
        $extensionConfig->loadServices($container);
        $container->set(Config::CONFIG_CONTAINER_ID, $extensionConfig);


        // Adds the list of notifier classes to the constructor.
        $notifiers = [];
        if (!empty($config['notifiers'])) {
            foreach ($config['notifiers'] as $className => $params) {
                $notifiers[] = new $className($params);
            }
        }
        $definition->addArgument($notifiers);
    }
}
