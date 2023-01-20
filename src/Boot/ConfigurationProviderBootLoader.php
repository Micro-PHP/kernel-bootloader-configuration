<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Framework\Kernel\Boot;

use Micro\Framework\Kernel\Configuration\ApplicationConfigurationFactoryInterface;
use Micro\Framework\Kernel\Configuration\ApplicationConfigurationInterface;
use Micro\Framework\Kernel\Configuration\DefaultApplicationConfigurationFactory;
use Micro\Framework\Kernel\Configuration\Resolver\PluginConfigurationClassResolver;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\PluginBootLoaderInterface;

class ConfigurationProviderBootLoader implements PluginBootLoaderInterface
{
    private readonly ApplicationConfigurationInterface $applicationConfiguration;

    /**
     * @param array<string|mixed>|ApplicationConfigurationInterface|ApplicationConfigurationFactoryInterface $config
     */
    public function __construct(
        array|ApplicationConfigurationInterface|ApplicationConfigurationFactoryInterface $config
    ) {
        $applicationConfig = $config;

        if (\is_array($config)) {
            $applicationConfig = new DefaultApplicationConfigurationFactory($config);
        }

        if ($applicationConfig instanceof ApplicationConfigurationFactoryInterface) {
            $applicationConfig = $applicationConfig->create();
        }
        /**
         * @psalm-suppress PossiblyInvalidPropertyAssignmentValue
         *
         * @phpstan-ignore-next-line
         */
        $this->applicationConfiguration = $applicationConfig;
    }

    /**
     * {@inheritDoc}
     */
    public function boot(object $applicationPlugin): void
    {
        if (!($applicationPlugin instanceof ConfigurableInterface)) {
            return;
        }

        $applicationPlugin->setConfiguration(
            $this->createPluginConfigurationClassResolver()
                 ->resolve(\get_class($applicationPlugin))
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function createPluginConfigurationClassResolver(): PluginConfigurationClassResolver
    {
        return new PluginConfigurationClassResolver($this->applicationConfiguration);
    }
}
