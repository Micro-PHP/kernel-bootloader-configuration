<?php

namespace Micro\Framework\Kernel\Plugin;

use Micro\Framework\Kernel\Configuration\PluginConfigurationInterface;

interface ConfigurableInterface
{
    /**
     * @return PluginConfigurationInterface
     */
    public function configuration(): PluginConfigurationInterface;

    /**
     * @param PluginConfigurationInterface $pluginConfiguration
     *
     * @return void
     */
    public function setConfiguration(PluginConfigurationInterface $pluginConfiguration): void;
}