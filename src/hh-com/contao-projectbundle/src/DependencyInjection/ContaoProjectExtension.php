<?php

declare(strict_types=1);

/*
 * This file is part of ContaoSimpleEvents.
 *
 * (c) Harald Huber
 *
 * @license LGPL-3.0-or-later
 */

namespace Hhcom\ContaoProjectBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ContaoProjectExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $mergedConfig, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../config')
        );

        $loader->load('parameters.yml');
        $loader->load('services.yml');
        $loader->load('listener.yml');
        $loader->load('controller.yml');
    }
}