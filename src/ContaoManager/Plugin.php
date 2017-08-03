<?php

/**
 * @copyright 2017 Webrealisierung GmbH
 *
 * @license LGPL-3.0+
 */

namespace Wr\ReferencesBundle\ContaoManager;

use Wr\ReferencesBundle\WrReferencesBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * @author Daniel Steuri <mail@webrealisierung.ch>
 * @package Wr\ReferencesBundle
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(WrReferencesBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}