<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\CoreBundle\DependencyInjection\Compiler;

use \Mockery as m;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use ASF\CoreBundle\DependencyInjection\Compiler\ASFEntityManagerPass;

/**
 * Compiler Pass for Entity Managers tagged services
 *  
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ASFEntityManagerPassTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test compiler pass without any services are defined as entity manager
     */
    public function testProcessWithoutDefinedServices()
    {
    	$container = new ContainerBuilder();
    	
    	$compiler = new ASFEntityManagerPass();
    	$compiler->process($container);
    }
    
    /**
     * Test compiler pass with service defined as entity manager but no custom Entity Manager and with FQCN entity class name
     */
    public function testProcessWithoutManagerClassAndWithFQCNEntity()
    {
    	$manager = m::mock('ASF\CoreBundle\Entity\Manager\ASFEntityManager');
    	$container = new ContainerBuilder();
    	$container->register('foo.manager', $manager)->addTag('asf_core.manager', array('entity' => 'ASF\CoreBundle\Tests\Fixtures\Manager\MockUser'));
    	 
    	$compiler = new ASFEntityManagerPass();
    	$compiler->process($container);
    	$this->assertTrue($container->hasDefinition('foo.manager'));
    }
    
    /**
     * Test compiler pass with service defined as entity manager but no custom Entity Manager and with short entity class name
     */
    public function testProcessWithoutManagerClassAndWithShortEntity()
    {
        $manager = m::mock('ASF\CoreBundle\Entity\Manager\ASFEntityManager');
        $container = new ContainerBuilder();
        $container->register('foo.manager', $manager)->addTag('asf_core.manager', array('entity' => 'ASFCoreBundle:MockUser'));
    
        $compiler = new ASFEntityManagerPass();
        $compiler->process($container);
    
        $this->assertTrue($container->hasDefinition('foo.manager'));
    }
}