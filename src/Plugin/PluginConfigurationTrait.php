<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Framework\Kernel\Plugin;

use Micro\Framework\Kernel\Configuration\PluginConfigurationInterface;

trait PluginConfigurationTrait
{
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
