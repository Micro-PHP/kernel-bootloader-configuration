<?php

namespace Micro\Framework\Kernel\Plugin;

use Micro\Framework\Kernel\Configuration\PluginConfigurationInterface;

trait PluginConfigurationTrait
{
    /**
     * @var PluginConfigurationInterface
     */
    private PluginConfigurationInterface $configuration;

    /**
     * {@inheritDoc}
     */
    public function setConfiguration(PluginConfigurationInterface $pluginConfiguration): void
    {
        $this->configuration = $pluginConfiguration;
    }

    /**
     * {@inheritDoc}
     */
    public function configuration(): PluginConfigurationInterface
    {
        return $this->configuration;
    }
}