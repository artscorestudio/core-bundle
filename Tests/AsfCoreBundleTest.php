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

use \Mockery as m;
use ASF\CoreBundle\ASFCoreBundle;

/**
 * Core Bundle Test Suites
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFCoreBundleTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * (non-PHPdoc)
	 * @see \Symfony\Component\HttpKernel\Bundle\Bundle::build()
	 */
	public function testBuild()
	{
		$container = $this->getContainer();
		
		$bundle = new ASFCoreBundle();
		$bundle->build($container);
	}
	
	/**
	 * Return a mock object of ContainerBuilder
	 *
	 * @return \Symfony\Component\DependencyInjection\ContainerBuilder
	 */
	protected function getContainer($bundles = null, $extensions = null)
	{
		$container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
		$container->shouldReceive('addCompilerPass');
		return $container;
	}
}