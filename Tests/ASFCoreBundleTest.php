<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ASF\CoreBundle\Tests;

use ASF\CoreBundle\ASFCoreBundle;

/**
 * Core Bundle Test Suites.
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 */
class ASFCoreBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @cover \ASF\CoreBundle\ASFCoreBundle
     */
    public function testBuild()
    {
        $container = $this->getContainer();

        $bundle = new ASFCoreBundle();
        $bundle->build($container);
    }

    /**
     * Return a mock object of ContainerBuilder.
     *
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected function getContainer()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $container->method('addCompilerPass');

        return $container;
    }
}
