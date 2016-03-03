<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\Tests\DependencyInjection;

use ASF\CoreBundle\DependencyInjection\ASFCoreExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Test ASFExtension Class
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ASF\CoreBundle\DependencyInjection\ASFExtension::mapsParameters
     */
	public function testMapsParameters()
	{
	    $stub = $this->getMockForAbstractClass('ASF\CoreBundle\DependencyInjection\ASFExtension');
		$container = new ContainerBuilder();
		$stub->mapsParameters($container, 'asf_core', array('test' => true));
		$this->assertTrue($container->hasParameter('asf_core.test'));
	}
	
}
