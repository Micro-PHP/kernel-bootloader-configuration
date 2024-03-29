<?php

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Framework\Kernel\Configuration\Resolver;

class PluginNameResolver implements PluginConfigurationClassResolverInterface
{
    /**
     * {@inheritDoc}
     */
    public function resolve(string $pluginClass): string
    {
        return $pluginClass.'Configuration';
    }
}
