<?php

declare(strict_types=1);

namespace Hhcom\ContaoProjectBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Symfony\Component\Routing\RouteCollection;
use Hhcom\ContaoProjectBundle\ContaoProjectBundle;

class Plugin implements BundlePluginInterface, RoutingPluginInterface
{
	
	 /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoProjectBundle::class) 
                ->setLoadAfter([
                    'Contao\CoreBundle\ContaoCoreBundle'
                    ]),
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel): RouteCollection|null
    {
        return $resolver
            ->resolve(__DIR__.'/../../config/routing.yml')
            ->load(__DIR__.'/../../config/routing.yml')
        ;
    }
}