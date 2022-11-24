<?php

namespace Micro\Framework\Kernel\Boot;

use Micro\Framework\Kernel\Configuration\ApplicationConfigurationFactoryInterface;
use Micro\Framework\Kernel\Configuration\ApplicationConfigurationInterface;
use Micro\Framework\Kernel\Configuration\DefaultApplicationConfigurationFactory;
use Micro\Framework\Kernel\Configuration\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\PluginBootLoaderInterface;

class ConfigurationProviderBootLoader implements PluginBootLoaderInterface
{
    private readonly ApplicationConfigurationInterface $configuration;

    /**
     * @param array|ApplicationConfigurationInterface|ApplicationConfigurationFactoryInterface $config
     */
    public function __construct(
        array|ApplicationConfigurationInterface|ApplicationConfigurationFactoryInterface $config
    )
    {
        $applicationConfig = $config;

        if(is_array($config)) {
            $applicationConfig = (new DefaultApplicationConfigurationFactory($config));
        }

        if(($applicationConfig instanceof ApplicationConfigurationFactoryInterface)) {
            $applicationConfig = $applicationConfig->create();
        }

        $this->configuration = $applicationConfig;
    }

    /**
     * {@inheritDoc}
     */
    public function boot(object $applicationPlugin): void
    {
       if(!($applicationPlugin instanceof ConfigurableInterface)) {
            return;
       }

       $applicationPlugin->setConfiguration($this->configuration);
    }
}